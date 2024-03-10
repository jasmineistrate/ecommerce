@extends('layouts.admin')
@section('content')
<div class="payment-success-massage">
    <div class="flex w-full justify-center items-center flex-col gap-y-5">
        <div class="text-green-500 text-xl mt-8">
            Payment has been successful
        </div>
        <a class= "bg-green-500 text-white p-4 rounded" href="{{route('orders')}}">Go to your orders</a>
    </div>
</div>
@endsection