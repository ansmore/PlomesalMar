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
        <p id="descriptionDigitalizacion"></p>
        <h1 id="titleNuevo"></h1>
 

        <button id="buttonHello"></button>
        <script type="module" src="{{ asset('js/dictionary.js') }}"></script>
        <script type="module" src="{{ asset('js/app.js') }}"></script>
    </body>

</html>
