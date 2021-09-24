@extends('dashboard')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">
            <div class="mb-3">
                <a href="{{ route('products.create') }}" class="btn btn-xs btn-info pull-right">Add Product</a>
                <a class="btn btn-xs btn-info pull-right" style="color: white" id="downloadCsv">Download CSV</a>
                <a href={{route('products.import_form')}} class="btn btn-xs btn-info pull-right" id="importCsv">Import CSV</a>
            </div>
            <form action="" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group" style="display: inline ">
                    <input type="text" id="name" name="name" placeholder="Search name" value="{{ request()->name }}">
                </div>
                <div class="form-group" style="display: inline ">
                    <input type="text" id="supplier" name="supplier" placeholder="Search supplier"
                        value="{{ request()->supplier }}">
                </div>
                <div class="form-group" style="display: inline ">
                    <input type="text" id="price" name="price" placeholder="Search price" value="{{ request()->price }}">
                </div>
                <div class="form-group" style="display: inline ">
                    <select name="type" id="type">
                        <option></option>
                        @foreach ($types as $type)
                            <option
                            {{ request()->type == $type->name ? 'selected' : '' }}
                            value="{{ $type->name }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="display: inline ">
                    <select name="attribute" id="attribute">
                        <option></option>
                        @foreach ($attributes as $attribute)
                            <option
                            {{ request()->attribute == $attribute->name ? 'selected' : '' }}
                            value="{{ $attribute->name }}">{{ $attribute->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </nav>
    </div>
    <div class="info mt-0 row mh-100">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width:2%" class="text-center">STT</th>
                    <th scope="col" style="width:5%" class="text-center">ID</th>
                    <th scope="col" style="width:5%" class="text-center">Name</th>
                    <th scope="col" style="width:5%" class="text-center">Type</th>
                    <th scope="col" style="width:20%" class="text-center">Attribute</th>
                    <th scope="col" style="width:5%" class="text-center">Price</th>
                    <th scope="col" style="width:20%" class="text-center">Supplier</th>
                    <th scope="col" style="width:20%" class="text-center">Image</th>
                    <th scope="col" style="width:20%" class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="thien1">
                        <td class="text-center"><input data-id="{{ $product->id }}" class="stt" type="number" style="width: 80px" value="{{ $product->stt }}"/></td>
                        <td class="text-center" class="id">{{ $product->id }}</td>
                        <td class="text-center">{{ $product->name }}</td>
                        <td class="text-center">{{ $product->type->name }}</td>
                        <td class="text-center">
                            @foreach ($product->attributes as $attribute)
                                {{ $attribute['name'] }} : {{ $attribute->pivot->value }}
                                <br>
                            @endforeach
                        </td>
                        <td class="text-center">{{ $product->price }}</td>
                        <td class="text-center">{{ $product->supplier }}</td>
                        <td class="text-center">
                            @if(isset($product->medias[0]['path']))
                                <img src="{{ asset('/storage/images/' . $product->medias[0]['path']) }}" alt="">
                            @endif
                        </td>
                        <td class="text-center d-flex">
                            <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                class="btn btn-info">Edit</a>
                            <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST"
                                class="ml-2">
                                @csrf
                                @method("DELETE")
                                <button type="submit" onclick="return  confirm('Are you sure?')"
                                    class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
    $(document).ready(function() {
        var submitted = false;
        $("#downloadCsv").click(function (e) {
            if(!submitted){
                submitted = true;
                const params = new URLSearchParams({
                  name: $("input[id=name]").val(),
                  supplier: $("input[id=supplier]").val(),
                  price: $("input[id=price]").val(),
                  type: $("select[id=type]").val(),
                  attribute: $("select[id=attribute]").val(),
                });
                window.location = "{{route('products.export_csv')}}?"+ params;
            }
        })

        $("input[class=stt]").focusout(function (e) {
            submitted = true;
            const params = new URLSearchParams({
                  oldId: $(this).data('id'),
                  stt: $(this).val(),
                });
            
            window.location = "{{route('products.updateStt')}}?"+ params;
        })
    });
</script>
@endsection
