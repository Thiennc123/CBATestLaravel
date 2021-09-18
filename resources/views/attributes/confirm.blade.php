@extends('dashboard')

@section('main_content')
<div class="header">
    <nav class="navbar navbar-light bg-light ">
        <h3>Please confirm before Attribute!!!</h3>
    </nav>
</div>
<div class="info mt-0 row mh-100">
    @if(isset($request['id']))
        <form class="w-50" action="{{ route('attributes.update', ['attribute' => $request->id]) }}" method="post">
        @method('put')
    @else
        <form action="{{ route('attributes.store') }}" method="POST">
    @endif
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name Attribute</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name of type" value="{{$request['name']}}" >
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-xs btn-info pull-right">Return</a>
    @if(isset($request['id']))
        <button type="submit" class="btn btn-primary">Update Attribute</button>
    @else
        <button type="submit" class="btn btn-primary">Store Attribute</button>
    @endif
    </form>
</div>
@endsection
