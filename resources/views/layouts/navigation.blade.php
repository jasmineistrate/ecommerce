<div class="navbar">
<a href="{{route('dashboard')}}">Dashboard</a>
@if(auth()->user()->isAdmin)
    <div class="dropdown">
    <button class="dropbtn">Users<i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="{{route('admin.users')}}">View Users</a>
      <a href="{{route('admin.create')}}">Create User</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Orders 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="{{route('admin.order')}}">View Orders</a>
      <a href="{{route('admin.create.order')}}">Create Order</a>
    </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn">Orders 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
        <a href="{{route('admin.products')}}">Product</a>
      <a href="{{route('create.product')}}">Create Product</a>
    </div>
  </div>
@endif

@if(Auth::check())
        <img src="{{asset('productImages/'. auth()->user()->image)}}" class="w-8 rounded-full" alt="">
        <form action="{{route('logout')}}" class="form-logout" method="POST">
                @csrf
                <button class="text-white logout-button" type="submit">Log Out</button>
        </form>
        @else
        <div class="text-white nav-element"><a class="clear-link" href="/login">Log in</a></div>
        <div class="text-white nav-element"><a class="clear-link" href="/register">Register</a></div>
        @endif
</div>