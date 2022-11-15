<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('bootstrap')
</head>
<body>
<div class="container mt-5">
        <div class="text-center">
        <h1>Registration Form</h1>
        </div>
    <form method="POST" enctype="multipart/form-data" action="signup">
        @csrf
        <div class="row justify-content-center mt-5">
            <div class="col-1">
                Name:
            </div>
            <div class="col-5">
                <input class="form-control" type="text" name="rname">
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-1">
               Password:
            </div>
            <div class="col-5">
                <input class="form-control" type="password" name="rpass">
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-1">
                Contact:
            </div>
            <div class="col-5">
                <input class="form-control" type="number" name="rcontact">
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-1">
                Photo:
            </div>
            <div class="col-5">
                <input class="form-control" type="file" name="rphoto">
            </div>
        </div>


        <div class="row justify-content-center mt-5">

            <div class="col-1">
               <input type="submit" class="btn btn-outline-primary rounded-pill" value="Register" name="Submit">
            </div>
        </div>
    </form>
    </div>
    <div class="row justify-content-center mt-5">

            <div class="col-3">
            Already a User? <a href={{URL::to('/')}} class="btn btn-outline-info rounded-pill">Login Now</a>
            </div>
        </div>


</body>
</html>
