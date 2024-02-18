@extends('layouts.admin')
@section('content')
        <div class="show-container">
            <div class="show-inner">
                <img src="{{asset('productImages/'.$product->image)}}" class="image-product-show" alt="">
                <div class="show-title">{{$product->title}}</div>
                <div class="show-price">{{$product->price}}$</div>
                <div class="show-color-parent">
                    <div class="show-color" style="color:{{$product->color}}">{{$product->color}}</div>
                    <div class="color-square" style="background-color:{{$product->color}}"></div>
                </div>
                <div class="show-description">{!!$product->description!!}</div>
            </div>
        </div>
@endsection