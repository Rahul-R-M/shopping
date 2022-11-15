<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-link active" href={{URL::to('loadcategory')}}>Category</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href={{URL::to('loadsubcategory')}}>Sub category</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href={{URL::to('loadproduct')}}>Add Product</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href={{URL::to('adminloadorder')}}>Orders</a>
        </li>
      </ul>
    </div>
    <ul class="nav justify-content-end ms-3 ">
        <li class="nav-item ">
        <a href={{URL::to('logout')}} class="btn btn-outline-success">Logout</a>
        </li>
</ul>
  </div>
</nav>
