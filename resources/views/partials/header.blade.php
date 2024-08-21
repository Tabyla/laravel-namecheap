<header>
    <nav class="container">
        <div>
            @auth
            <a href="{{ route('dashboard') }}">
                <img class="logo" src="https://www.sandbox.namecheap.com/cdn/1202/assets/img/logos/namecheap.svg" alt="logo img"/>
            </a>
            @else
                <a href="{{ route('login') }}">
                    <img class="logo" src="https://www.sandbox.namecheap.com/cdn/1202/assets/img/logos/namecheap.svg" alt="logo img"/>
                </a>
            @endauth
        </div>
        <div class="nav__links">
            <a href="{{ route('domain') }}" class="catalog">Домены</a>
            <div class="nav-icon-links">
                @auth
                    <p>{{$userName . ' - ' . $userBalance . '$'}}</p>
                @else
                    <p></p>
                @endauth
            </div>
        </div>
    </nav>
</header>
