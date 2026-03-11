<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>@yield('title', 'Заголовок')</title>
</head>
<body class="bg-white">
<nav class="navbar navbar-expand-lg navbar-light bg-light" >
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
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => request()->is('/')]) aria-current="page" href="/">Главная</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => false]) href="/">Features</a>
                </li>
                <li class="nav-item">
                    @auth
                        <a
                            class="nav-link"
                            href="{{ route('auth.logout') }}"
                        >
                            Выход
                        </a>
                    @else
                        <a
                            @class(['nav-link', 'active' => request()->routeIs('user.auth.index')])
                            href="{{ route('user.auth.index') }}"
                        >
                            Вход
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-3">
    @yield('body')
</div>
</body>
</html>
