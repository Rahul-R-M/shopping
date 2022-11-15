<?php

use App\Http\Controllers\mycontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/register', function () {
    return view('register');
});

Route::get('/', function () {
    return view('login');
});

Route::post('/signup',[mycontroller::class,'signup']);

Route::post('/login',[mycontroller::class,'login']);

Route::get('/home',[mycontroller::class,'loadhome']);

Route::post('/addtocart',[mycontroller::class,'addtocart']);

Route::get('/loadcart',[mycontroller::class,'loadcart']);

Route::get('/removecart/{cid}',[mycontroller::class,'removecart']);

Route::post('/buynow',[mycontroller::class,'buynow']);

Route::get('/order',[mycontroller::class,'loadorder']);

Route::get('/logout',[mycontroller::class,'logout']);

Route::post('/addcategory',[mycontroller::class,'addcategory']);

Route::post('/addsubcategory',[mycontroller::class,'addsubcategory']);

Route::post('/addproduct',[mycontroller::class,'addproduct']);

Route::get('/loadproduct',[mycontroller::class,'loadproduct']);

Route::get('/loadcategory',[mycontroller::class,'loadcategory']);

Route::get('/loadsubcategory',[mycontroller::class,'loadsubcategory']);

Route::get('/loadorder',[mycontroller::class,'loadorder']);

Route::get('/adminloadorder',[mycontroller::class,'adminloadorder']);

Route::get('/delsubcat/{scid}',[mycontroller::class,'delsubcat']);

Route::get('/editdata/{pid}',[mycontroller::class,'editdata']);

Route::get('/delproduct/{pid}',[mycontroller::class,'delprod']);

Route::post('editproduct',[mycontroller::class,'editproductt']);

Route::post('/sortorder',[mycontroller::class,'loadsortorder']);

Route::post('/search1',[mycontroller::class,'search']);


Route::get('search', [mycontroller::class, 'autosearch'])->name('search');
