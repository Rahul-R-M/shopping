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
        <form method="POST" action="addsubcategory">
            @csrf

            <div class="row justify-content-center">
                <div class="row text-center mb-3">

                    <h3>Sub Category Page</h1>
                </div>
                <div class="col-2">
                    Select Category:
                </div>
                <div class="col-5">
                    <select class="form-control" name="cids">
                        @foreach ($cat as $c)
                        <option value={{$c->category_id}}>{{$c->cname}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-2">
                    sub category Name:
                </div>
                <div class="col-5">
                    <input class="form-control" type="text" name="subcatname" placeholder="Sub Category N ame">
                </div>

            </div>
            <div class="row justify-content-center mt-5">

                <div class="col-1">
                    <input class="btn btn-outline-primary" type="submit" name="Submit" value="ADD Sub Category">
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
        <table class="table table-dark" border=1 align="center" width="1000px" style="margin-top: 100px">

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
                    Action
                </th>
            </tr>
            @php($sr=1)
            @foreach ($subcat as $s)
            <tr>
                <td>{{$sr++}}</td>
                <td>{{$s->cname}}</td>
                <td>{{$s->sname}}</td>
                <td><a href={{URL::to("delsubcat/".$s->subcat_id)}} class="btn btn-outline-danger">Delete</a></td>
            </tr>
            @endforeach
            {{-- <?php
                    $con = mysqli_connect("localhost", "root", "", "shopping_cart");
                    $qry = "select cm.cname,sc.subcat_id,sc.sname,cm.cname from category_master cm,subcategory_master sc where cm.category_id=sc.category_id order
                 by cm.cname,sc.sname";

                    $result = mysqli_query($con, $qry) or die(mysqli_error($con));
                    $i = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        // $pid=$row['product_id'];
                        $cname = $row[0];
                        $scid = $row[1];
                        $scname = $row[2];

                        echo "<tr>";
                        echo "<td>$i</td>";
                        echo "<td>$cname</td>";
                        echo "<td>$scname</td>";
                        echo "<td>" ?><a href="delsubcategory.php?scid=<?php echo "$scid"; ?>">Delete</a> <?php echo "</td>";
                                                                                                        echo "</tr>";
                                                                                                        $i++;
                                                                                                    }
                                                                                                        ?>  --}}


        </table>
    </div>
    <script src="" async defer></script>
</body>
<?php
if (isset($_POST['Submit'])) {
    $con = mysqli_connect("localhost", "root", "", "shopping_cart");
    $scnam = $_POST['subcatname'];
    $cid = $_POST['cids'];
    $qry = "insert into subcategory_master(category_id,sname) values($cid,'$scnam')";
    mysqli_query($con, $qry) or die(mysqli_error($con));
    header("location:./subcategory.php");
}
?>

</html>