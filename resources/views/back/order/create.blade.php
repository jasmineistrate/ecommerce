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
        <input type="text" placeholder="total price" name="total_price" class="create-form-input">
        <input type="text" placeholder="quantity" name="quantity" class="create-form-input">
        <input type="text" placeholder="address" name="adress" class="create-form-input">
        <input type="text" placeholder="city" name="city" class="create-form-input">
        <input type="text" placeholder="country" name="country" class="create-form-input">
        <select name="status">
            <option value="paid">Paid</option>
            <option value="preparing">Preparing</option>
            <option value="shipped">Shipped</option>
        </select>
        <button class="button-create-product" style="background-color:black" type="submit">Create</button>
    </form>
</div>

@endsection