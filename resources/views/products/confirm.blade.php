@extends('dashboard')

@section('main_content')
<div class="header">
    <nav class="navbar navbar-light bg-light ">
        <h3>Please confirm before actions!!!</h3>
    </nav>
</div>
<div class="info mt-0 row mh-100">
    @if(isset($request['id']))
        <form class="w-50" action="{{ route('types.update', ['type' => $request->id]) }}" method="post">
        @method('put')
    @else
        <form action="{{ route('types.store') }}" method="POST">
    @endif
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name Type</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name of type" value="{{$request['name']}}" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <input type="description" class="form-control" name="description" id="description" placeholder=" Enter description" value="{{$request['description']}}">
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-xs btn-info pull-right">Return</a>
    @if(isset($request['id']))
        <button type="submit" class="btn btn-primary">Update Type</button>
    @else
        <button type="submit" class="btn btn-primary">Store Type</button>
    @endif
    </form>
</div>
@endsection
