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
<form method="POST" action={{URL::to("editproduct")}}>
@csrf
    <input type="hidden" name="pid" value="{{$data[0]->product_id}}">
    <div class="row justify-content-center mt-5">
        <div class="col-2">
            Product Name:
        </div>
        <div class="col-4">
            <input class="form-control" value={{$data[0]->pname}} type="text" name="pname">
        </div>

    </div>
    <div class="row justify-content-center mt-1">
        <div class="col-2">
            Product Price:
        </div>
        <div class="col-4">
            <input class="form-control" value={{$data[0]->pprice}} type="text" name="price">
        </div>

    </div>

    <div class="row justify-content-center mt-1">
        <div class="col-2">
            Product Qty:
        </div>
        <div class="col-4">
            <input class="form-control" value={{$data[0]->pqty}} type="text" name="pqty">
        </div>

    </div>

    <div class="row justify-content-center mt-5">

        <div class="col-1">
            <input class="btn btn-primary" type="submit" name="submit" value="edit">
        </div>

    </div>
    </form>
    </div>
</body>
</html>
