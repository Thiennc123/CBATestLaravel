@extends('dashboard')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">
            <div class="float-right mr-4 col-4">
                <a href="{{ route('attributes.create') }}" class="btn btn-xs btn-info pull-right">Add Attribute</a>
            </div>
        </nav>
    </div>
    <div class="info mt-0 row mh-100">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope=" col" style="width:5%" class="text-center">ID</th>
                    <th scope="col" style="width:20%" class="text-center">Name</th>
                    <th scope="col" style="width:20%" class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($attributes as $attribute)
                <tr class="thien1">
                    <td class="text-center">{{$attribute->id}}</td>
                    <td class="text-center">{{$attribute->name}}</td>
                    <td class="text-center d-flex">
                        <a href="{{ route('attributes.edit', ['attribute' => $attribute->id]) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('attributes.destroy', ['attribute' => $attribute->id]) }}" method="POST" class="ml-2">
                            @csrf
                            @method("DELETE")
                            <button type="submit" onclick="return  confirm('Are you sure?')"
                                class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach()
            </tbody>
        </table>
    </div>
@endsection
