<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
    @include('bootstrap')
</head>
<body>
@include('admin.navbar')
<div class="container">
<form method="POST" action="addproduct" enctype="multipart/form-data">
@csrf
    <div class="row justify-content-center mt-5">
    <div class="row text-center mb-3">

<h3>Product Page</h1>
</div>
        <div class="col-2">
            Select Sub Category:
        </div>
        <div class="col-4">
            <select class="form-control" name="scid">
                @foreach ($subcat as $s)
                <option value={{$s->subcat_id}}>{{$s->sname}}</option>
                @endforeach
                {{--  <?php
                $con = mysqli_connect("localhost", "root", "", "shopping_cart");

                $qry = "select * from subcategory_master";

                $result = mysqli_query($con, $qry) or die(mysqli_error($con));

                while ($row = mysqli_fetch_array($result)) {
                    $scid=$row[0];
                    $scname = $row[2];
                    echo "<option value='$scid'>$scname</option>";
                } ?>  --}}

            </select>
        </div>

    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-2">
            Product Name:
        </div>
        <div class="col-4">
            <input class="form-control" type="text" name="productname">
        </div>

    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-2">
            Product Price:
        </div>
        <div class="col-4">
            <input class="form-control" type="text" name="productprice">
        </div>

    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-2">
            Product Photo:
        </div>
        <div class="col-4">
            <input class="form-control" type="file" name="productphoto">
        </div>

    </div>
    <div class="row justify-content-center mt-3">
    <!-- <div class="col-5">
          &nbsp;
        </div>        -->
        <div class="col-1">
            <input class="btn btn-outline-primary" type="submit" name="Submit" value="ADD Product">
        </div>

    </div>
    </form>
    </div>
    <div class="item">
    <div class="item-name">
                &nbsp;
            </div>

        </div>
<div class="container">
    <table class="table table-striped" border=1 align="center" width="1000px" style="margin-top: 100px">

        <tr>
            <th>
                Sr.
            </th>
            <th>
               Category Name
            </th>
            <th>
               Sub Category Name
            </th>
            <th>
                Product Name
            </th>
            <th>
                Product Price
            </th>
            <th>
                Qty&nbsp;&nbsp;&nbsp;
            </th>
            <th>
                Photo
            </th>
            <th>
                Action
            </th>

</tr>
@php($sr=1)
@foreach ($prod as $p)
<tr>
    <td>{{$sr++}}</td>
    <td>{{$p->cname}}</td>
    <td>{{$p->sname}}</td>
   <td>{{$p->pname}}</td>
    <td>{{$p->pprice}}</td>
    <td>{{$p->pqty}}</td>
    <td><image height="100px" width="100px" src={{asset("uploads/".$p->photo)}} ></image></td>
    <td><a href={{URL::to("editdata/".$p->product_id)}} class="btn btn-outline-success">Edit</a>&nbsp;&nbsp;
    <a href={{URL::to("delproduct/".$p->product_id)}} class="btn btn-outline-danger">Delete</a></td>
    </tr>
@endforeach



    </table>
    </div>
    <script src="" async defer></script>
</body>


</html>
