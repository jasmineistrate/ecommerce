@extends('layouts.admin')
@section('content')
<div class="title-section">
    <div class="title">Create Product</div>
</div>
<div class="product-create-section">
    <form class="form-create-product" action="{{route('store.product')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="title" name="title" class="create-form-input">
        <input type="text" placeholder="price" name="price" class="create-form-input">
        <input type="text" placeholder="color" name="color" class="create-form-input">
        <textarea name="description" cols="30" rows="10"></textarea>
        <input type="file" name="image">
        <button class="button-create-product" type="submit">Submit</button>
    </form>
</div>

@endsection