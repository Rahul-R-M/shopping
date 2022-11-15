<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
        @include('bootstrap')
    </head>
    <body>

    <div class="container align-middle mt-5">

        <div class="text-center mt-5 mb-5">
            <h1 >Login Form</h1>
            </div>
        <form method="POST" action="login">
            @csrf
        <div class="row justify-content-center mt-5">
        <div class="col-1 ">
            <h6>
                Contact:
            </h6>


            </div>
            <div class="col-5">
                <input class="form-control" type="text" name="lcont">
            </div>
        </div>
        <div class="row justify-content-center mt-3">
        <div class="col-1">
                <h6 >Pass:</h6>
            </div>
            <div class="col-5">
                <input class="form-control" type="password" name="lpass">
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-1">
            <input type="submit" class="btn btn-outline-primary rounded-pill" value="Log In" name="Submit">
            </div>

        </div>

    </form>

    </div>
    </div>
    <div class="row justify-content-center mt-5">

            <div class="col-2">
            Not a User? <a href={{URL::to('register')}} class="btn btn-outline-info rounded-pill">Register Now</a>
            </div>
        </div>

</body>
        <script src="" async defer></script>

</html>
