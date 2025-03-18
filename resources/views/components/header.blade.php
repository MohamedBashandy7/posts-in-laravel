<header>
    <div class="container d-flex justify-content-between">
        <div>
            <h3>Home</h3>
        </div>
        <ul>
            <li>About</li>
            <li>Contact</li>
        </ul>
        @guest
            <div class="auth_info">
                <a class="auth" href="{{ route('register') }}">register</a>
                <a class="auth" href="{{ route('login') }}">login</a>
            </div>
        @endguest
        @auth
            <div class="dropdown auth_info">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ auth()->user()->name }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if (request()->routeIs('dashboard'))
                        <li><a class="dropdown-item" href="{{ route('posts.index') }}">Home</a></li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <li><button type="submit" class="dropdown-item">Logout</button></li>
                    </form>
                </ul>
            </div>
        @endauth
    </div>
</header>