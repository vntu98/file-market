<nav style="margin-top: 10px" class="nav">
    <div style="display: flex; justify-content: space-between;" class="container">
        <div class="nav-left">
            <a href="{{ route('home') }}" class="nav-item is-brand">
               {{ config('app.name') }}
            </a>
        </div>

        <span class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
        </span>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;" class="nav-right nav-menu">
            @if (auth()->check())
                <a style="margin-right: 15px" href="#" class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sign out
                </a>

                <a href="{{ route('account') }}" class="nav-item">
                    Your account
                </a>

                @if (auth()->user()->hasRole('admin'))
                    <a style="margin-left: 15px" href="{{ route('admin.index') }}" class="nav-item">
                        Admin
                    </a>
                @endif
            @else
                <a style="margin-right: 15px" href="{{ route('login') }}" class="nav-item">
                    Sign in
                </a>

                <div class="nav-item">
                    <a href="{{ route('register') }}" class="button">
                        Start selling
                    </a>
                </div>
            @endauth
        </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="is-hidden" id="logout-form">
        @csrf
    </form>
</nav>