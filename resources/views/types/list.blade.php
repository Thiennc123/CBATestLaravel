@extends('dashboard')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">
            <div class="float-right mr-4 col-4">
                <a href="{{ route('types.create') }}" class="btn btn-xs btn-info pull-right">Add Type</a>
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
                @foreach($types as $type)
                <tr class="thien1">
                    <td class="text-center">{{$type->id}}</td>
                    <td class="text-center">{{$type->name}}</td>
                    <td class="text-center d-flex">
                        <a href="{{ route('types.edit', ['type' => $type->id]) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('types.destroy', ['type' => $type->id]) }}" method="POST" class="ml-2">
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
