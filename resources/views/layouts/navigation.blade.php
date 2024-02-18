
<div class="navigation">
        <div class="nav-left">
        <div class="nav-element"><a class="clear-link" href="{{route('dashboard')}}">Dashboard</a></div>
        <div class="nav-element"><a class="clear-link" href="{{route('create.product')}}">Create Product</a></div>
        <div class="nav-element"><a class="clear-link" href="{{route('admin.products')}}">Products</a></div>
        <div class="nav-element"><a class="clear-link" href="{{route('admin.users')}}">Users</a></div>
        <div class="nav-element"><a class="clear-link" href="{{route('admin.create')}}">Create users</a></div>
        </div>
        <div class="nav-right">
        @if(Auth::check())
        <form action="{{route('logout')}}" method="POST">
                @csrf
                <button class="logout-button" type="submit">Log Out</button>
        </form>
        @else
        <div class="nav-element"><a class="clear-link" href="/login">Log in</a></div>
        <div class="nav-element"><a class="clear-link" href="/register">Register</a></div>
        @endif
        </div>
        
</div>