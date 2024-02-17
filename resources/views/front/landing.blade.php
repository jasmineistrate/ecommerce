@extends('layouts.front')
@section('content')
        <div class="products-section">
            <div class="products-inner">
            @foreach($products as $product)
                <div class="product-card">
                    <img class="product-image" src="{{asset('productImages/'.$product->image)}}">
                    <div class="product-content">
                    <div class="product-title">
                        {{$product->title}}
                    </div>
                    <div class="product-color">
                        {{$product->color}}
                    </div>
                    <div class="product-price">
                        {{$product->price}}$
                    </div>
                    <div class="add-button">Add to cart</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
@endsection