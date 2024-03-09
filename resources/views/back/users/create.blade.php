@extends('layouts.admin')
@section('content')
<div class="title-section">
    <div class="title">Create User</div>
</div>
<div class="product-create-section">
    <form class="form-create-product" action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="name" name="name" class="create-form-input">
        <input type="email" placeholder="email" name="email" class="create-form-input">
        <input type="password" placeholder="password" name="password" class="create-form-input">
        <input type="password" placeholder="confirm password" name="confirmPassword" class="create-form-input">
        <input type="file" name="image">
        <select name="isAdmin">
            <option value="1">Admin</option>
            <option value="0">User</option>
        </select>
        <button class="button-create-product" style="background-color:black" type="submit">Submit</button>
    </form>
</div>

@endsection