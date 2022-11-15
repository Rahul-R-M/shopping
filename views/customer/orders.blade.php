<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('bootstrap')
</head>
<body>
@include('navbar')
<div class="container">


            @php($id=0)

            @foreach ($data as $d1)
            @php($total=0)
            @php($sr=1)
            <table class="table table-dark mt-5 w-100">
                <thead>
                    <tr>
                        <th></th>
                        <th>Transaction ID:{{$d1[$id]->transaction_id}}</th>
                        <th>{{" Order Date:".$d1[$id]->order_date}}</th>
                    </tr>
                  <tr>
                    <th scope="col" style="width:70px;">#</th>
                    <th scope="col" style="width:250px;">Name</th>
                    <th scope="col" style="width:250px;">Price</th>
                  </tr>
                </thead>
                <tbody>
            @foreach ($d1 as $d)
            <tr>
                <th>{{$sr++}}</th>
                <td>{{$d->pname}}</td>
                  <td>{{$d->pprice}}</td>
                    @php($total+=$d->pprice)
              </tr>
            @endforeach
            <tr>
                <td colspan="2"></td>
                <td><b>Total :</b> {{$total}}</td>
            </tr>
        </tbody>
    </table>
            @endforeach

</div>
</body>
</html>
