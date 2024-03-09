@extends('layouts.admin')
@section('content')
<div class="title-section">
    <div class="title">Edit Order</div>
</div>
<div class="product-create-section">
    <form class="form-create-product" action="{{route('admin.update.order', $order->id)}}" method="POST">
        @csrf
        @method('PUT')
        <select multiple name="products[]">
            @foreach($products as $product)
            <option class="text-black" value="{{$product->title}}">{{$product->title}}</option>
            @endforeach
        </select>
        <input type="text" value="{{$order->total_price}}" placeholder="total price" name="total_price" class="create-form-input">
        <input type="text" value="{{$order->quantity}}" placeholder="quantity" name="quantity" class="create-form-input">
        <input type="text" value="{{$order->adress}}" placeholder="address" name="adress" class="create-form-input">
        <input type="text" value="{{$order->city}}" placeholder="city" name="city" class="create-form-input">
        <input type="text" value="{{$order->country}}" placeholder="country" name="country" class="create-form-input">
        <select name="status">
            <option value="paid">Paid</option>
            <option value="preparing">Preparing</option>
            <option value="shipped">Shipped</option>
        </select>
        <button class="button-create-product" style="background-color:black" type="submit">Update</button>
    </form>
</div>

@endsection