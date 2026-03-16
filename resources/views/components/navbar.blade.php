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
                        'class' => ['nav-link', 'active' => request()->is('/')]
                    ],
                ] as $pathParams)

                    <li class="nav-item">
                        <a @class($pathParams['class']) aria-current="page" href="{{ $pathParams['route'] }}">
                            {{ $pathParams['title'] }}
                        </a>
                    </li>
                @endforeach
                <li class="nav-item">
                    <a
                        @class(['nav-link', 'active' => request()->routeIs('user.auth.index')])
                        href="{{ route('user.auth.index') }}"
                    >
                        Вход
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
