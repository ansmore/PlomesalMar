<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name')}} - @yield('titulo')</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{asset('js/helpers/dictionary.js')}}" defer></script>
        <script src="{{asset('js/digitalizacion.js')}}" defer></script>
    </head>
    <body>
        @include('components.navigation')
        <div class="content">
            @yield('content')
        </div>
    </body>
</html>