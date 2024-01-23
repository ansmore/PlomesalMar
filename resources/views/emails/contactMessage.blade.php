<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>

<body class="mail p-3">
    <header class="mail row bg-light">
        <figure class="img-fluid col-2">
            <img src="{{ asset('img/logos/logo_biit.png') }}" alt="logo">
        </figure>
        <h1 class="col-10">{{ config('app.name') }}</h1>
    </header>
    <main>
        <h2>Missatge rebut: {{ $messages->mailsubject }}</h2>
        <p class="cursiva">De: {{ $messages->name }}
            <a href="mailto:{{ $messages->email }}">&lt;{{ $messages->email }}&gt;</a>
        </p>
        <p>{{ $messages->message }}</p>
    </main>
    <footer class="mail-footer bg-light">
        <p>Pymesoft </p>
    </footer>
</body>

</html>
