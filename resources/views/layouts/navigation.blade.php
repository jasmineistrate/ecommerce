
        <div class="navigation">
            <div class="nav-left">
            <div class="nav-element"><a class="clear-link" href="{{route('dashboard')}}">Dashboard</a></div>
            <div class="nav-element"><a class="clear-link" href="{{route('create.product')}}">Create Product</a></div>
            </div>
            <div class="nav-right">
            <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="logout-button" type="submit">Log Out</button>
            </form>
            </div>
        </div>