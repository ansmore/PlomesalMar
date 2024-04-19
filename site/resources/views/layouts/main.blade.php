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
    @include('components.navigationHome')
    @yield('content')
    @include('components.footer')

    @stack('scripts')
</body>

</html>
