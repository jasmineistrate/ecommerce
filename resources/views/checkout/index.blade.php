@extends('layouts.admin')
@section('content')
        <div class="checkout-container">
    <h2 class="checkout-header">Checkout</h2>
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
            <td class="cart-td">{{$cartItem->quantity}}</td>
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
            <td class="cart-total">{{$cartItems->total}}$</td>
        </tr>
        </table>
    </div>
    <form class="checkout-form mt-7" id="checkout-form" method="POST">
        @csrf
        <div>
            <label class="checkout-label" for="name">Name:</label>
            <input class="checkout-input" type="text" id="name" name="name" required>
        </div>
        <div>
            <label class="checkout-label" for="email">Email:</label>
            <input class="checkout-input" type="email" id="email" name="email" required>
        </div>
        <div>
            <label class="checkout-label" for="address">Address:</label>
            <input class="checkout-input" type="text" id="address" name="address" required>
        </div>
        <div>
            <label class="checkout-label" for="city">City:</label>
            <input class="checkout-input" type="text" id="city" name="city" required>
        </div>
        <div>
            <label class="checkout-label" for="country">Country:</label>
            <input class="checkout-input" type="text" id="country" name="country" required>
        </div>
        <div id="card-element" class="mt-7"></div>
                    <div id="card-errors" style="color: red" role="alert"></div>
                    <button type="submit" id="submit" class="mt-7 adminButton bg-green-500 py-2 rounded text-white">Pay now</button>
                    <div id="payment-message" class="hidden"></div>
    </form>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{asset('js/stripe.js')}}">

@endsection