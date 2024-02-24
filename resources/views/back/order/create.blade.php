@extends('layouts.admin')
@section('content')
<div class="title-section">
    <div class="title">Create Order</div>
</div>
<div class="product-create-section">
    <form class="form-create-product" action="{{route('admin.store.order')}}" method="POST">
        @csrf
        <select multiple name="products[]">
            @foreach($products as $product)
            <option class="text-black" value="{{$product->title}}">{{$product->title}}</option>
            @endforeach
        </select>
        <input type="text" placeholder="product name" name="product_name" class="create-form-input">
        <input type="text" placeholder="total price" name="total_price" class="create-form-input">
        <input type="text" placeholder="quantity" name="quantity" class="create-form-input">
        <input type="text" placeholder="address" name="address" class="create-form-input">
        <input type="text" placeholder="city" name="city" class="create-form-input">
        <input type="text" placeholder="country" name="country" class="create-form-input">
        <input type="text" placeholder="status" name="status" class="create-form-input">
        <button class="button-create-product" type="submit">Create</button>
    </form>
</div>

@endsection