<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Книжный магазин</a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @foreach([
                    [
                        'route' => '/',
                        'title' => 'Главная',
                        'class' => ['nav-link', 'active' => isCurrentPath('/')]
                    ],
                    [
                        'route' => '/',
                        'title' => 'Подписки',
                        'class' => ['nav-link', 'active' => false]
                    ]
                ] as $pathParams)
                    <li class="nav-item">
                        <a @class($pathParams['class']) aria-current="page" href="{{ $pathParams['route'] }}">
                            {{ $pathParams['title'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div>
            @auth
                <a
                    class="btn btn-outline-danger"
                    href="{{ route('user.auth.logout') }}"
                >
                    Выход
                </a>
            @endauth
        </div>
    </div>
</nav>
