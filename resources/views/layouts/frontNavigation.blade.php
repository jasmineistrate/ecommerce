<div class="navigation">
        <div class="nav-left">
        <a href="{{route('landing')}}"><img src="{{asset('icons/logo.png')}}" class="w-8" alt=""></a>
        <div class="nav-element"><a class="clear-link" href=""></a></div>
        </div>
        <div class="nav-right">
        @if(Auth::check())
        <img src="{{asset('productImages/'. auth()->user()->image)}}" class="w-8 rounded-full" alt="">
        <form action="{{route('logout')}}" method="POST">
                @csrf
                <button class="text-white logout-button clear-link" type="submit">Log Out</button>
        </form>
        <a class="clear-link" href="{{route('dashboard')}}">Dashboard</a>
        @else
        <div class="nav-element"><a class="clear-link" href="/login">Log in</a></div>
        <div class="nav-element"><a class="clear-link" href="/register">Register</a></div>
        @endif
        </div>
</div>