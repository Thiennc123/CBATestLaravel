@extends('dashboard')

@section('main_content')
<div class="header">
    <nav class="navbar navbar-light bg-light ">
        <h3>Add Attribute</h3>
    </nav>
</div>
<div class="info mt-0 row mh-100">
    <form action="{{ route('attributes.confirm') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name Attribute</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name of type">
        </div>
        <button type="submit" class="btn btn-primary">Create Attribute</button>
    </form>
</div>
<div>
    @foreach ($errors->all() as $error)
    <li style="color: red">{{ $error }}</li>
    @endforeach
</div>
@endsection
