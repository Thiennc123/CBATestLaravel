@extends('dashboard')

@section('main_content')
<div class="header">
    <nav class="navbar navbar-light bg-light ">
        <h3>Add Product</h3>
    </nav>
</div>
<div class="info mt-0 row mh-100">
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name Product</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name of type">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">amount</label>
            <input type="text" class="form-control" name="amount" id="amount" placeholder=" Enter description">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder=" Enter description">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">supplier</label>
            <input type="text" class="form-control" name="supplier" id="supplier" placeholder=" Enter description">
        </div>
        <div class="col-md-12">
            Type:
            <select id="type" name="type" class="browser-default custom-select">
                      <option value="" selected>Type</option>
                      @foreach($types as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div>
<div>
    @foreach ($errors->all() as $error)
    <li style="color: red">{{ $error }}</li>
    @endforeach
</div>
@endsection
