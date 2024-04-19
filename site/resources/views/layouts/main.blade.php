<!DOCTYPE html>
<html lang="{{ session('language', 'en') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    @vite(['resources/sass/main.scss'])
    <script src="https://kit.fontawesome.com/811a7316ca.js" crossorigin="anonymous"></script>
    <title>{{ config('app.name') }} - @yield('title')</title>
</head>

<body>
    {{-- <ul class="navbar-nav-main">
        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login', ['language' => $language]) }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register', ['language' => $language]) }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} aqui
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout', ['language' => $language]) }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }} aqui 2
                    </a>
                    <form id="logout-form" action="{{ route('logout', ['language' => $language]) }}" method="POST"
                        class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul> --}}
    @include('components.navigationHome')
    @yield('content')
    @include('components.footer')

    @stack('scripts')
</body>

</html>
