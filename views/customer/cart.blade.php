<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('bootstrap')

<body>
    @include('navbar')
    <div style='margin-top:50px' class='container'>
        <table class='table table-info' border=2>
            <tr>
                <th>
                    Product Name
                </th>
                <th>
                    Product Price
                </th>
                <th>
                    Qty
                </th>
                <th>
                    Action
                </th>
            </tr>
            @php($t=0)

            @foreach ($cart as $c)
            <tr>
                <td>
                    {{$c->pname}}
                </td>
                <td>
                    {{$c->pprice}}@php($t+=$c->pprice)
                </td>
                <td>{{$c->qty}}</td>
                <td><a href={{URL::to('removecart/'.$c->cart_id)}} class="btn btn-outline-danger">Remove</a></td>
            </tr>
            @endforeach
    </div>
    <tr>
        <td align='right'>Total :</td>
        <td>{{$t}} </td>
        <td></td>
    </tr>
    </table>
    </div>
    <div>
        <form method='POST' class='row justify-content-center' action="buynow">
            @csrf
            <div class='col-2'>
                <input style='margin-left:100px;margin-top:10px;' type='submit' class='btn btn-outline-primary' name='Submit' value='Buy Now'>
            </div>
        </form>
    </div>
    {{-- </div><tr> <td colspan=3 align='center'> Cart is Empty</td></tr></table></div>  --}}

</body>

</html>