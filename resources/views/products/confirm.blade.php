@extends('dashboard')

@section('main_content')
    <div class="header">
        <nav class="navbar navbar-light bg-light ">
            <h3>Please confirm before actions!!!</h3>
        </nav>
    </div>
    <div class="info mt-0 row mh-100">
        @if (isset($product['id']))
            <form class="w-50" action="{{ route('products.update', ['product' => $product['id']]) }}"
                method="post">
                @method('put')
            @else
                <form action="{{ route('products.store') }}" method="POST">
        @endif
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name Product</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name of type"
                value="{{ $product['name'] }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">amount</label>
            <input type="text" class="form-control" name="amount" id="amount" placeholder=" Enter description"
                value="{{ $product['amount'] }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder=" Enter description"
                value="{{ $product['price'] }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">supplier</label>
            <input type="text" class="form-control" name="supplier" id="supplier" placeholder=" Enter description"
                value="{{ $product['supplier'] }}">
        </div>
        <div>
            {{ $type['name'] }}
            <input type="hidden" name="type_id" value="{{ $type['id'] }}">
        </div>
        <div>
            @foreach ($product['attribute'] as $key => $value)
                {{ $key }} : {{ $value }}
                <input type="hidden" name="value[]" value="{{ $value }}">
                <br>
            @endforeach
            @foreach ($product['id_attribute'] as $item)
                <input type="hidden" name="attribute_product_id[]" value="{{ $item }}">
            @endforeach
        </div>
            @foreach ($product['url'] as $key => $value)
                <img src="{{ asset('/storage/tmp/' . $value) }}" alt="" style="width: 100px; height: 100px; display: inline">
            @endforeach
        
        <input type="hidden" name="path[]" value="{{ json_encode($product['url'])}}" >
        <div class="d-block mt-5">
            <a href="{{ url()->previous() }}" class="btn btn-xs btn-info pull-right">Return</a>
            @if (isset($product['id']))
                <button type="submit" class="btn btn-primary">Update product</button>
            @else
                <button type="submit" class="btn btn-primary ">Store product</button>
            @endif
        </div>

        </form>
    </div>
@endsection
