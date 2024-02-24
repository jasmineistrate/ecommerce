@extends('layouts.admin')
@section('content')
        <div class="show-container">
            <div class="show-inner">
                <img src="{{asset('productImages/'.$user->image)}}" class="image-product-show" alt="">
                <div class="show-title">{{$user->name}}</div>
                <div class="show-price">{{$user->email}}</div>
                @if($user->isAdmin)
                <div class="show-price">This user is Admin</div>
                @else
                <div class="show-price">This is a simple User</div>
                @endif
            </div>
        </div>
@endsection