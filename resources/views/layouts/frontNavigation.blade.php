<div class="navigation">
        <div class="nav-left">
        <div class="nav-element"><a class="clear-link" href=""></a></div>
        <div class="nav-element"><a class="clear-link" href=""></a></div>
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