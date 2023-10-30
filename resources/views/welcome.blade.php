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

<body class="antialiased">
    <h1>Welcome</h1>
    <p>This is the welcome page, Welcomed!!</p>

    <button id="buttonHello">Say hello </button>
    <script type="module" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
