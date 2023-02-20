<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Sub's Kingdom</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home
                        <span class="visually-hidden">(current)</span>
                    </a>
                </li>
                @auth()
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}"  href="{{ route('profile') }}">Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('history') ? 'active' : '' }}" href="{{ route('history') }}">Histórico</a>
                    </li>
                @endauth
            </ul>
            <div class="d-flex">
                <a href="{{ $twitchUrl }}" class="btn btn-secondary my-2 my-sm-0">Entrar com Twitch</a>
            </div>
        </div>
    </div>
</nav>
