@extends('layouts.front')
@section('content')
    <h2 class = "text-3xl text-black bold mt-7">Shopping Cart</h2>
    @if(Cart::name('shopping')->getDetails()->items_count)
    <div class="shopping-cart mt-7">
        <table class="cart-table">
        <tr>
            <th class="cart-th">Product</th>
            <th class="cart-th" >Price</th>
            <th class="cart-th">Quantity</th>
            <th class="cart-th">Total</th>
            <th class="cart-th">Action</th>
        </tr>
        @foreach($cartItems->items as $cartItem)
        <tr class="cart-tr">
            <td class="cart-td">
                <div class="image-product-cart flex justify-items-center">
                    <img src="{{asset('productImages/'. $cartItem->options->image)}}" class="w-8" alt="">
                    <div>{{$cartItem->title}}</div>
                </div>
            </td>
            <td class="cart-td">{{$cartItem->price}}</td>
            <td class="cart-td">
                <div class="flex gap-x-2 items-center">
                    <img src="{{asset('icons/minus.png')}}" x-on:click="updateMinusQuantity('{{$cartItem->hash}}', '{{$cartItem->quantity}}')" class = "w-8 cursor-pointer hover:scale-105 ">
                    <div id="{{$cartItem->hash}}">{{$cartItem->quantity}}</div>
                    <img src="{{asset('icons/plus.png')}}" x-on:click="updatePlusQuantity('{{$cartItem->hash}}', '{{$cartItem->quantity}}')" class = "w-8 cursor-pointer hover:scale-105">
                </div>
            </td>
            <td class="cart-td">{{$cartItem->total_price}}$</td>
            <td class="cart-td">
                <form action="{{route('cart.delete', $cartItem->hash)}}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button class="button-icon"><img src="{{asset('/icons/delete.png')}}" class="icon-image" alt=""></button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3" class="cart-total">Total:</td>
            <td class="cart-total mt-4" x-text="'$' + totalPrice">
            </td>
        </tr>
        </table>
    </div>
    <div class="w-full flex justify-center mt-4">
        <a class="flex justify-center w-32 bg-blue-600 text-white py-2 rounded-lg" href="{{route('checkout.index')}}">Check out</a>
    </div>
    @else
        <div class="flex flex-col items-center gap-y-4">
            <div class="text-xl">No items in the cart</div>
            <a class="flex justify-center w-32 bg-blue-600 text-white py-2 rounded-lg" href="{{route('landing')}}">Buy some</a>
        </div>
    @endif


@endsection