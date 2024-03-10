<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href= "{{asset('/css/front.css')}}">
        <link rel="stylesheet" href= "{{asset('/css/style.css')}}">
        <link rel="stylesheet" href= "{{asset('/css/cartStyle.css')}}">
        <link rel="stylesheet" href= "{{asset('/css/checkout.css')}}">
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        
    </head>
    <body x-data="app()" class="font-sans antialiased">
            @if(session()->has('success'))
            <div class="success-message">
                {{ session()->get('success') }}
            </div>
            @endif
        @include('layouts.frontNavigation')
        @yield('content')
        <a class="cart-icon-link" href="{{route('cart.index')}}">
            <div class="cart-parent">
                <img class="cart-icon-image" src="{{asset('/icons/cart.png')}}" alt="">
                @if(Cart::name('shopping')->getDetails()->items_count)
                <div class="cart-items-count">
                    <div class="items-count text-white text-sm" >{{Cart::name('shopping')->getDetails()->items_count}}</div>
                </div>
                @endif
            </div>
        </a>
    </body>
    <!--<script src="{{asset('js/count.js')}}"></script>-->
    <script src="{{asset('js/cart.js')}}"></script>
</html>