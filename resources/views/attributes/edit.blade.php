@extends('dashboard')

@section('main_content')
<div class="header">
    <nav class="navbar navbar-light bg-light ">
        <h3>Edit Attribute</h3>
    </nav>
</div>
<div class="info mt-0 row mh-100">
    <form action="{{ route('attributes.confirm') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name Attribute</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name of type" value="{{$attribute['name']}}" >
        </div>
        <input type="text" name="id" value="{{$attribute['id']}}" hidden="true">
        <a href="{{ url()->previous() }}" class="btn btn-xs btn-info pull-right">Return</a>
        <button type="submit" class="btn btn-primary">Update Attribute</button>
    </form>
</div>
@endsection
