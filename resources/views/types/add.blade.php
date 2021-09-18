@extends('dashboard')

@section('main_content')
<div class="header">
    <nav class="navbar navbar-light bg-light ">
        <h3>Add Type</h3>
    </nav>
</div>
<div class="info mt-0 row mh-100">
    <form action="{{ route('types.confirm') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name Type</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name of type">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <input type="description" class="form-control" name="description" id="description" placeholder=" Enter description">
        </div>
        <button type="submit" class="btn btn-primary">Create Type</button>
    </form>
</div>
<div>
    @foreach ($errors->all() as $error)
    <li style="color: red">{{ $error }}</li>
    @endforeach
</div>
@endsection
