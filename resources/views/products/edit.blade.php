@extends('dashboard')

@section('main_content')
<div class="header">
        <nav class="navbar navbar-light bg-light ">
            <h3>Edit Product</h3>
        </nav>
    </div>
    <div class="info mt-0 row mh-100">
        <form action="{{ route('products.confirm') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Name Product</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name of type" value="{{$product->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">amount</label>
                <input type="text" class="form-control" name="amount" id="amount" placeholder=" Enter description" value="{{$product->amount}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder=" Enter description" value="{{$product->price}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">supplier</label>
                <input type="text" class="form-control" name="supplier" id="supplier" placeholder=" Enter description" value="{{$product->supplier}}">
            </div>
            <div>
                Type:
                <select id="type" name="type" class="browser-default custom-select">
                    @foreach ($types as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="attribute">
            </div>
            <div class="form-group">
                <label for="inputPassword4">Image</label>
                <input type="file" class="form-control file" placeholder="Image" name="file[]" id="file" multiple>
            </div>
            <input type="text" name="id" value="{{$product->id}}" hidden="true">
            <button type="submit" class="btn btn-primary">Create Product</button>
        </form>
    </div>
    <div>
        @foreach ($errors->all() as $error)
            <li style="color: red">{{ $error }}</li>
        @endforeach
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#type').on('change', function() {
                $('#attribute').empty();
                var id = $('#type').val();
                var url = '{{ route('product.get_get_attribte', ':id') }}';
                url = url.replace(':id', id);
                $.ajax({
                    type: "get",
                    url: url,
                    success: function(res) {
                        res.forEach(addInputFeild);

                        function addInputFeild(res) {
                            $('#attribute').append(
                                '<div>' + res['name'] +
                                '<input type="hidden" name="id_attribute[]" value="' + res[
                                    'id'] +
                                '"><input class="form-control input-sm" type="text" name="attribute[' +
                                res['name'] +
                                ']">'
                            );
                        }
                    }
                });
            });
        });
    </script>
@endsection
