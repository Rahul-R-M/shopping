<?php

namespace App\Http\Controllers;

use App\Models\cart_master;
use App\Models\category_master;
use App\Models\order_master;
use App\Models\product_master;
use App\Models\register_master;
use App\Models\subcategory_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mycontroller extends Controller
{
    function signup(Request $req)
    {
        $file = $req->file('rphoto');
        $fname = $file->getClientOriginalName();
        $fext = $file->getClientOriginalExtension();
        $newfname = substr($fname, 0, stripos($fname, '.')) . rand(1000, 2000) . '.' . $fext;
        $file->move(public_path('/uploads'), $newfname);
        $data = new register_master;
        $data->rname = $req->rname;
        $data->rphone = $req->rcontact;
        $data->rpass = $req->rpass;
        $data->rphoto = $newfname;
        $data->save();
        return redirect('/');
    }
    function login(Request $req)
    {
        if ($req->lcont == 'admin' && $req->lpass == 'admin') {
            session_start();
            $_SESSION['admin'] = "admin";
            $prod = product_master::all();
            return redirect('loadcategory');
        } else {
            $data = register_master::select('Register_ID')->where(['rpass' => $req->lpass, 'rphone' => $req->lcont])->get();
            if ($data->isEmpty()) {
                return redirect('register');
            } else {
                session_abort();
                session_start();
                $_SESSION['rid'] = $data[0]->Register_ID;
                return redirect('home');
            }
        }
    }
    function loadhome()
    {
        session_abort();
        session_start();
        if (!isset($_SESSION['rid'])) {
            return redirect('/');
        }
        $prod = DB::table('product_master')->get();
        return view('customer.home', ['prod' => $prod, 'sr' => 1]);
    }
    function addtocart(Request $req)
    {
        if ($req->submit == "Add to cart") {
            session_abort();
            session_start();
            $rid = $_SESSION['rid'];
            $cartdata = cart_master::select('Product_ID')->where('register_id', $rid)->get();
            $flg = false;
            foreach ($cartdata as $c) {
                if ($c->Product_ID == $req->pid) {
                    global $flg;
                    $flg = true;
                }
            }
            if ($flg) {
                $qt = cart_master::where(['register_id' => $rid, 'Product_ID' => $req->pid])->get();
                cart_master::where(['register_id' => $rid, 'Product_ID' => $req->pid])->update(["qty" => ($qt[0]->qty + $req->pqty)]);
            } else {
                $data = new cart_master;
                $data->Product_ID = $req->pid;
                $data->register_id = $rid;
                $data->qty = $req->pqty;
                $data->save();
            }

            return redirect('home');
        }
    }

    function loadcart()
    {
        session_abort();
        session_start();
        if (!isset($_SESSION['rid'])) {
            return redirect('/');
        }
        session_abort();
        session_start();
        $rid = $_SESSION['rid'];
        $data = DB::table('cart_master')->join("product_master", "cart_master.Product_ID", "=", "product_master.product_id")->where(["cart_master.register_id" => $rid])->get();
        return view('customer.cart', ["cart" => $data]);
    }

    function removecart($cid)
    {
        cart_master::where(['cart_id' => $cid])->delete();
        return redirect('loadcart');
    }

    function buynow()
    {
        session_abort();
        session_start();
        $rid = $_SESSION['rid'];
        $cart = DB::table('cart_master')->where(['register_id' => $rid])->get();
        $transid = rand(0, 100000);
        foreach ($cart as $c) {
            $data = new order_master;
            $data->transaction_id = $transid;
            $data->register_id = $rid;
            $data->product_id = $c->Product_ID;
            $data->order_date = date("Y-m-d");
            $data->qty = $c->qty;
            $data->save();
            $qt = product_master::select('pqty')->where("product_id", $c->Product_ID)->get();
            product_master::where("product_id", $c->Product_ID)->update(["pqty" => ($qt[0]->pqty - $c->qty)]);
        }
        cart_master::where(["register_id" => $rid])->delete();
        return redirect('home');
    }
    function loadorder()
    {
        session_abort();
        session_start();
        if (!isset($_SESSION['rid'])) {
            return redirect('/');
        }
        session_abort();
        session_start();
        $rid = $_SESSION['rid'];
        $tid = DB::table('order_master')->select('transaction_id')->distinct()->where(['register_id' => $rid])->get();
        $data = array();
        foreach ($tid as $t) {
            $data1 = DB::table('order_master')->select()->join('product_master', 'order_master.product_id', '=', 'product_master.Product_ID')->where(['transaction_id' => $t->transaction_id, 'order_master.register_id' => $rid])->get();
            $data[] = $data1;
        }
        // print_r($data);
        return view('customer.orders', ["data" => $data]);
    }

    function adminloadorder()
    {
        session_abort();
        session_start();
        if (!isset($_SESSION['admin'])) {
            return redirect('/');
        }
        $tid = DB::table('order_master')->select('transaction_id')->distinct()->get();
        $data = array();
        foreach ($tid as $t) {
            $data1 = DB::table('order_master')->select()->join('product_master', 'order_master.product_id', '=', 'product_master.Product_ID')->join('register_master', 'register_master.Register_ID', '=', 'order_master.register_id')->where(['transaction_id' => $t->transaction_id])->get();
            $data[] = $data1;
        }
        return view('admin.orders', ["data" => $data]);
    }

    function logout()
    {
        session_abort();
        session_start();
        session_unset();
        return redirect('/');
    }
    function addcategory(Request $req)
    {
        $data = new category_master;
        $data->cname = $req->catname;
        $data->save();
        return redirect('loadcategory');
    }
    function loadcategory()
    {
        session_abort();
        session_start();
        if (!isset($_SESSION['admin'])) {
            return redirect('/');
        }
        $data = category_master::get();
        return view('admin.category', ["data" => $data]);
    }
    function loadsubcategory()
    {
        session_abort();
        session_start();
        if (!isset($_SESSION['admin'])) {
            return redirect('/');
        }
        $cat = category_master::get();
        $subcat = DB::table('subcategory_master')->join('category_master', 'category_master.category_id', '=', 'subcategory_master.category_id')->get();
        return view('admin.subcategory', ["cat" => $cat, "subcat" => $subcat]);
    }
    function delsubcat($scid)
    {
        DB::table('subcategory_master')->where(["subcat_id" => $scid])->delete();
        return redirect('loadsubcategory');
    }
    function addsubcategory(Request $req)
    {
        $data = new subcategory_master;
        $data->category_id = $req->cids;
        $data->sname = $req->subcatname;
        $data->save();
        return redirect('loadsubcategory');
    }
    function loadproduct(Request $req)
    {
        session_abort();
        session_start();
        if (!isset($_SESSION['admin'])) {
            return redirect('/');
        }
        $subcat = DB::table('subcategory_master')->get();
        $prod = DB::table('product_master')->join('subcategory_master', 'subcategory_master.subcat_id', '=', 'product_master.subcat_id')->join('category_master', 'category_master.category_id', '=', 'subcategory_master.category_id')->get();
        return view('admin.addproduct', ["subcat" => $subcat, "prod" => $prod]);
    }
    function addproduct(request $req)
    {
        $data = new product_master;
        $data->pname = $req->productname;
        $data->subcat_id = $req->scid;
        $data->pprice = $req->productprice;
        $file = $req->file('productphoto');
        $fname = $file->getClientOriginalName();
        $fext = $file->getClientOriginalExtension();
        $newfname = substr($fname, 0, stripos($fname, '.')) . rand(1000, 100000) . '.' . $fext;
        $file->move(public_path('uploads/'), $newfname);
        $data->photo = $newfname;
        $data->save();
        return redirect('loadproduct');
    }
    function delprod($pid)
    {
        DB::table('product_master')->where(["product_id" => $pid])->delete();
        return redirect('loadproduct');
    }
    function loadsortorder(Request $req)
    {

        $tid = DB::table('order_master')->select('transaction_id')->distinct()->whereBetween('order_date', [$req->datefrom, $req->dateto])->get();
        $data = array();
        foreach ($tid as $t) {
            $data1 = DB::table('order_master')->select()->join('product_master', 'order_master.product_id', '=', 'product_master.Product_ID')->join('register_master', 'register_master.Register_ID', '=', 'order_master.register_id')->where(['transaction_id' => $t->transaction_id])->get();
            $data[] = $data1;
        }
        //  print_r($data);
        return view('admin.orders', ["data" => $data]);
    }

    // function search($d){
    //         session_abort();
    //         session_start();
    //         if(!isset($_SESSION['rid'])){
    //             return redirect('/');
    //         }
    //         $prod=DB::table('product_master')->where('pname','LIKE',$req->search.'%')->get();
    //         return view('customer.home',['prod'=>$prod,'sr'=>1]);
    // }


    function search(Request $req)
    {
        $data = DB::table('product_master')->select()->where('pname', 'LIKE', '%' . $req->name . '%')->get();
        return view('customer.home', ["prod" => $data, 'sr' => 1]);
    }
    function editdata($pid)
    {
        $data = DB::table('product_master')->select()->where('product_id', $pid)->get();
        return view('admin.Editproduct', ["data" => $data]);
    }

    function editproductt(Request $req)
    {

        if ($req->submit == "edit") {
            product_master::whereproduct_id($req->pid)->update(["pname" => $req->pname, "pprice" => $req->price, "pqty" => $req->pqty]);
            return redirect('loadproduct');
        }
    }

    function autosearch(Request $request)
    {
        if ($request->ajax()) {
            $data = Product_master::where('pname', 'LIKE', $request->name . '%')->get();
            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item">' . $row->pname . '</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">' . 'No Data Found' . '</li>';
            }
            if ($request->name == "")
                $output = "";
            return $output;
        }
        return view('home');
    }
}
