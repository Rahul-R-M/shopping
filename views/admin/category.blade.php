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
    <div class="container mt-5">
<form method="POST" action={{URL::to("addcategory")}}>
    @csrf
        <div class="row justify-content-center">
            <div class="row text-center mb-3">

                <h3>Category Page</h1>
            </div>
        <div class="col-2">
                Category Name:
            </div>
            <div class="col-5">
                <input class="form-control" type="text" name="catname" placeholder="Category Name">
            </div>
        </div>

        <div class="row justify-content-center mt-5">

            <div class="col-1">
               <input class="btn btn-outline-primary" type="submit" name="Submit" value="ADD Category">
            </div>
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
        <table class="table table-dark" border="1" align="center" width="1000px" style="margin-top: 100px">

        <tr>
            <th>
                Sr.
            </th>
            <th>
               Category Name
            </th>

</tr>
@php($sr=1)
@foreach ($data as $d)
<tr>
    <td>
        {{$sr++}}
    </td>
    <td>
        {{$d->cname}}
    </td>
</tr>
@endforeach
            {{--  <?php

            $con = mysqli_connect("localhost","root","","shopping_cart");
                $qry="select * from category_master";

                $result = mysqli_query($con,$qry) or die(mysqli_error($con));
                $i=1;
                while($row=mysqli_fetch_array($result)){
                    // $pid=$row['product_id'];
                    $cid=$row[0];
                    $cname=$row[1];
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>$cname</td>";
                    echo "<td>"?><a href="delcategory.php?cid=<?php echo "$cid"; ?>">Delete</a> <?php echo "</td>";
                    echo "</tr>";
                    $i++;
                }
            ?>  --}}

    </table>
    </div>
</body>

{{--  <?php

if(isset($_POST['Submit'])){
    $name=$_POST['catname'];
    $con = mysqli_connect("localhost","root","","shopping_cart");
    $qry="insert into category_master(cName) values('$name')";
    mysqli_query($con,$qry) or die(mysqli_error($con));
    header('location:category.php');
}
?>  --}}

</html>
