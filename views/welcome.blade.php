<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script> -->
@include("link")
<form action="insertdata" method="post">
    @csrf
    <div class="container">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="uname" aria-describedby="emailHelp">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">age</label>
            <input type="number" name="age" class="form-control" id="exampleInputPassword1">
        </div>

        <button type="submit" value="insert" name="op" class="btn btn-primary">INsert</button>
    </div>
    <div class="container mt-5">
    <table class="table table-striped table-dark w-50">
  <tr>
    <th>ROLL NO</th>
    <th>NAME</th>
    <th>AGE</th>
    <th colspan="2">ACTION</th>
  </tr>
  @foreach($data as $d)
  <tr>
    <td>{{$d['rollno']}}</td>
    <td>{{$d['name']}}</td>
    <td>{{$d['age']}}</td>
    <td><a href="" class="btn btn-success"  >EDIT</a></td>
    <!-- <td><a href ={{"deletedata/".$d['rollno']}} class="btn btn-danger">DELETE</a></td> -->
    <td><a href ="deletedata/{{$d->rollno}}" class="btn btn-danger">DELETE</a></td>

  </tr>
  @endforeach

</table>
</div>
</form>
