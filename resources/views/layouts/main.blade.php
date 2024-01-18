<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://kit.fontawesome.com/811a7316ca.js" crossorigin="anonymous"></script>
    <title>{{ config('app.name') }} - @yield('title')</title>
</head>

<body>
    {{-- <p>
        {{ Session::get('language', 'en') }}
    {{-- </p> --}}
    {{-- <?php
    
    // var_dump('main.blade ', 'language');
    ?> --}}
    <div class="content">
        @yield('content')
    </div>
    @include('components.footer')
</body>

</html>
