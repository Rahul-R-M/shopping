<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <title>Document</title>
    @include('bootstrap')
</head>

<body>
    {{--  <script>
        function search(val){
            var xmlhttp;
            if(window.XMLHttpRequest){
                xmlhttp = new XMLHttpRequest();
            }
            xmlhttp.onreadystatechange=function(){
                if(this.readyState==4 && this.status==200){
                    document.getElementById('hinttext').innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","search/"val,true);
            xmlhttp.send();
        }
    </script>  --}}
    @include('navbar')

<form method="POST" action="search1">
    @csrf
        <div class="row justify-content-center mt-5">

                <div class="col-5">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Search By Name..." >
                </div>

                <div class="col-3"> <input type="submit" value="Search" class="btn btn-outline-primary"></div>

        </div>
        <!-- <div class="row justify-content-center mt-5">
            <div class="col-5">
            <div id="product_list"></div></div>
            <div class="col-3"> &nbsp;</div>

    </div> -->

    </form>
    </div>

    </form>
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Photo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($prod as $p)

                    <tr>
                        <form action={{URL::to("addtocart")}} method="POST">
                            @csrf
                            <input type="hidden" name="pid" value="{{$p->product_id}}">
                        <th>{{ $sr++ }}</th>
                        <td>{{ $p->pname }}</td>
                        <td>{{ $p->pprice }}</td>
                        <td>
                            <image width="100px" height="100px" src={{ asset('uploads/' . $p->photo) }}></image>
                        </td>
                        <td>
                            <input type="number" max="{{$p->pqty}}" min="1" name="pqty" value="1">
                        </td>
                        <td> <input type="submit" name="submit" value="Add to cart"></input></td>
                    </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
$(document).ready(function(){
$('#name').on('keyup',function () {
var query = $(this).val();
$.ajax({
url:'{{ route('search') }}',
type:'GET',
data:{'name':query},
success:function (data) {
$('#product_list').html(data);
}
})
});
$(document).on('click', 'li', function(){
var value = $(this).text();
$('#name').val(value);
$('#product_list').html("");
});
});
</script>
</body>

</html>
