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
@include('admin.navbar')

<div class="container">
    <form method="POST" action="sortorder">
        @csrf
    <div class="ml-4 row mt-4">
        <div class="col-4">
            <b>From : </b><input class="form-control" type="date" name="datefrom">
        </div>
        <div class="col-4">
            <b>To : </b><input class="form-control" type="date" name="dateto">
        </div>
        <div class="col-4 mt-4">
         <input type="submit" class="btn btn-outline-primary" value="Search">

        </div>
    </div>
    
</form>
</div>
<div class="container">


            @php($id=0)

            @foreach ($data as $d1)
            @php($total=0)
            @php($sr=1)
            <table class="table mt-5 w-100">
                <thead>
                    <tr>
                        <th>Transaction ID:{{$d1[$id]->transaction_id}}</th>
                          <th>Customer Name :{{$d1[$id]->rname}}&nbsp;&nbsp;&nbsp;&nbsp;Conatact :{{$d1[$id]->rphone}}</th>
                         <th>{{" Order Date:".$d1[$id]->order_date}}</th>
                         <th>&nbsp;</th>
                    </tr>
                  <tr>
                    <th scope="col" style="width:70px;">*</th>
                    <th scope="col" style="width:250px;">Name</th>
                    <th scope="col" style="width:130px;">Qty</th>
                    <th scope="col" style="width:250px;">Price</th>
                  </tr>
                </thead>
                <tbody>
            @foreach ($d1 as $d)
            <tr>
                <th>{{$sr++}}</th>
                <td>{{$d->pname}}</td>
                <td>{{$d->qty}}</td>
                  <td>{{$d->pprice}}</td>

                    @php($total+=$d->pprice)
              </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td><b>Total :</b> {{$total}}</td>
            </tr>
        </tbody>
    </table>
            @endforeach

</div>
</body>
</html>
