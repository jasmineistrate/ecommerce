@extends('layouts.admin')
@section('content')
        <div class="products-admin-container">
        <div class="container">
        <h2>Orders</h2>
        <ul class="responsive-table">
            <li class="table-header">
            <div class="col col-1">Id</div>
            <div class="col col-2">Products Name</div>
            <div class="col col-3">Total Price</div>
            <div class="col col-4">Quantity</div>
            <div class="col col-4">Address</div>
            <div class="col col-4">City</div>
            <div class="col col-4">Country</div>
            <div class="col col-4">Status</div>
            <div class="col col-4">Created_at</div>
            </li>
            @foreach($orders as $order)
            <li class="table-row">
            <div class="col col-1" data-label="Job Id">{{$order->id}}</div>
            <div class="col col-2" data-label="Customer Name">{{$order->product_name}}</div>
            <div class="col col-3" data-label="Amount">{{$order->total_price}}</div>
            <div class="col col-4" data-label="Amount">{{$order->quantity}}</div>
            <div class="col col-4" data-label="Amount">{{$order->adress}}</div>
            <div class="col col-4" data-label="Amount">{{$order->city}}</div>
            <div class="col col-4" data-label="Amount">{{$order->country}}</div>
            <div class="col col-4" data-label="Amount">{{$order->status}}</div>
            <div class="col col-4" data-label="Amount">{{$order->created_at}}</div>
            </li>
            @endforeach
        </ul>
        </div>
        </div>
@endsection