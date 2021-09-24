@extends('dashboard')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">
            <h3>Import Product</h3>
        </nav>
    </div>
    <form method="POST" enctype="multipart/form-data" action="{{route('products.import_csv')}}">
    @csrf
        <div class="form-group">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" class="form-control-file" id="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
@endsection
