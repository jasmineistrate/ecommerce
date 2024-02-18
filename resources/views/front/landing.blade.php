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
                    <div class="add-button">Add to cart</div>
                    </div>
                </div></a>
                @endforeach
            </div>
        </div>
@endsection