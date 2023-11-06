<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>

    <body>
        <h1 id="title"></h1>
        <p id="description"></p>
                
        <button id="buttonHello"></button>
        <script type="module" src="{{ asset('js/helpers/dictionary.js') }}"></script> 
        <!-- <script type="module" src="{{ asset('js/app.js') }}"></script> -->
        <script type="module" src="{{ asset('js/home.js') }}"></script>
    </body>

</html>
