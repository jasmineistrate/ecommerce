@extends('layouts.admin')
@section('content')
        <div class="products-admin-container">
        <div class="container">
        <h2>All users</h2>
        <ul class="responsive-table">
            <li class="table-header">
            <div class="col col-1">Id</div>
            <div class="col col-2">Name</div>
            <div class="col col-3">Email</div>
            <div class="col col-4">ISadmin</div>
            <div class="col col-4">Created At</div>
            <div class="col col-4">Updated At</div>
            <div class="col col-4">Action</div>
            </li>
            @foreach($users as $user)
            <li class="table-row">
            <div class="col col-1" data-label="Job Id">{{$user->id}}</div>
            <div class="col col-2" data-label="Customer Name">{{$user->name}}</div>
            <div class="col col-3" data-label="Amount">{{$user->email}}</div>
            @if($user->isAdmin)
                <div class="col col-4">Admin</div>
            @else
                <div class="col col-4">User</div>
            @endif
            <div class="col col-4" data-label="Payment Status">{{$user->created_at}}</div>
            <div class="col col-4" data-label="Payment Status">{{$user->updated_at}}</div>
            <div class="col col-4" id="action-icons">
                <form action="{{route('admin.delete.user', $user->id)}}" method="POST">
                    @csrf 
                    @method('DELETE')
                    <button class="button-icon"><img src="{{asset('/icons/delete.png')}}" class="icon-image" alt=""></button>
                </form>
                <a href="{{route('admin.edit', $user)}}"><img src="{{asset('/icons/edit.png')}}" class="icon-image" alt=""></a>
                <a href="{{route('admin.show.user', $user->id)}}" ><img src="{{asset('/icons/show.png')}}" class="icon-image" alt=""></a>
            </div>
            </li>
            @endforeach
        </ul>
        </div>
        </div>
@endsection