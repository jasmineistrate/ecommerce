@extends('layouts.front')
@section('content')
        <div class="products-section">
            <div class="products-inner">
            @foreach($products as $product)
                <div class="product-card">
                    <a href="{{route('front.show.product', $product->id)}}">
                        <img class="product-image" src="{{asset('productImages/'.$product->image)}}">
                    </a>
                    <div class="product-content">
                    <div class="product-title">
                        {{$product->title}}
                    </div>

                    <div class="product-color">
                        {{$product->color}}
                    </div>
                    <div class="product-price">
                        {{$product->price}} $
                    </div>
                    <form action="{{route('cart.add')}}" method="POST">
                        @csrf
                        <input type="hidden" value = "{{$product->id}}" name="product_id">
                        <input type="hidden" value = "{{$product->title}}" name="product_title">
                        <input type="hidden" value = "{{$product->image}}" name="product_image">
                        <input type="hidden" value = "{{$product->price}}" name="product_price">
                        <input type="hidden" value = "{{$product->color}}" name="product_color">
                        <button class="add-button w-40" type="submit" style="background-color:black" >Add to cart</button>
                    </form>
                    </div>
                </div></a>
                @endforeach
            </div>
        </div>
@endsection