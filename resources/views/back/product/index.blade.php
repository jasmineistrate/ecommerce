@extends('layouts.admin')
@section('content')
        <div class="products-admin-container">
        <div class="container">
        <h2>All products</h2>
        <ul class="responsive-table">
            <li class="table-header">
            <div class="col col-1">Id</div>
            <div class="col col-2">Title</div>
            <div class="col col-3">Price</div>
            <div class="col col-4">Color</div>
            <div class="col col-4">Action</div>
            </li>
            @foreach($products as $product)
            <li class="table-row">
            <div class="col col-1" data-label="Job Id">{{$product->id}}</div>
            <div class="col col-2" data-label="Customer Name">{{$product->title}}</div>
            <div class="col col-3" data-label="Amount">{{$product->price}}</div>
            <div class="col col-4" data-label="Payment Status">{{$product->color}}</div>
            <div class="col col-4" id="action-icons">
                <form action="{{route('admin.product.delete', $product->id)}}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button class="button-icon"><img src="{{asset('/icons/delete.png')}}" class="icon-image" alt=""></button>
                </form>
                <a href="{{route('admin.product.edit', $product->id)}}" class=""><img src="{{asset('/icons/edit.png')}}" class="icon-image" alt=""></a>
                <a href="{{route('admin.product.show', $product->id)}}" class=""><img src="{{asset('/icons/show.png')}}" class="icon-image" alt=""></a>
            </div>
            </li>
            @endforeach
        </ul>
        </div>
        </div>
@endsection