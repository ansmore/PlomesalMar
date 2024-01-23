<!DOCTYPE html>
<html lang="{{ session('language', 'en') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- <link rel="stylesheet" href="../../../public/css/app.css"> --}}
    <script src="https://kit.fontawesome.com/811a7316ca.js" crossorigin="anonymous"></script>
    <title>{{ $dictionary['automatedResponse'] }}</title>
</head>

<body class="mail">
    <header class="mail row bg-light">
        <figure class="img-fluid col-2">
            <img src="https://media.istockphoto.com/id/1156307040/es/vector/escudo-escolar-dise%C3%B1o-dise%C3%B1o-de-vectores-educativos-ilustraci%C3%B3n-del-emblema-de-la-universidad.jpg?s=612x612&w=0&k=20&c=GhuIqLPgZ71p1wCmZRuLROvTRYqQIYgM9NeqGYnVZAs="
                alt="biit">
        </figure>
        <figure class="img-fluid col-2">
            <img src="https://i.pinimg.com/736x/9d/1f/43/9d1f434700aea18dfd4b993cc8db7f40.jpg" alt="pymesoft">
        </figure>
        <h1 class="col-10">{{ config('app.name') }}</h1>
    </header>
    <main class="mail">
        <h2>{{ $dictionary['thanksContact'] }}</h2>
        <p class="cursiva">{{ $dictionary['messageRecibed'] }}</p>
        <p>{{ $dictionary['messageDetails'] }}</p>
        <ul>
            <li>
                <span>{{ $dictionary['subject'] }}</span>
                <span>{{ $messages->mailsubject }}</span>
            </li>
            <li>
                <span>{{ $dictionary['name'] }}</span>
                <span>{{ $messages->name }}</span>
            </li>
            <li>
                <span>{{ $dictionary['email'] }}</span>
                <a href="mailto:{{ $messages->email }}">&lt;{{ $messages->email }}&gt;</a>
            </li>
            <li>
                <span>{{ $dictionary['message'] }}</span>
                <span>{{ $messages->message }}</span>
            </li>
        </ul>
        <p>{{ $dictionary['interest'] }}{{ config('app.name') }}{{ $dictionary['answer'] }}</p>
        <p>{{ $dictionary['additional'] }}</p>
    </main>
    <footer class="mail-footer bg-light">
        <p>{{ $dictionary['corporativeName'] }}{{ date('Y') }} </p>
    </footer>
</body>

</html>
