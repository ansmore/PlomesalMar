<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Respuesta Automática - Confirmación de Contacto</title>
</head>

<body class="mail p-3">
    <header class="mail row bg-light">
        <figure class="img-fluid col-2">
            <img src="public/img/logos/logo_biit.png" alt="1">
        </figure>
        <img src="public/img/banner.jpg" alt="2">
        <img src="public/img/logos/pymesoft_logo_text_full.png" alt="3">
        <img src="{{ asset('public/img/logos/logo_biit.png') }}" alt="4">
        <img src="{{ asset('/public/img/logos/logo_biit.png') }}" alt="5">
        <img src="{{ asset('public/img/banner.jpg') }}" alt="6">
        <img src="{{ asset('/public/img/banner.jpg') }}" alt="6b">
        <img src="{{ asset('./img/logos/logo_biit.png') }}" alt="7">
        <img src="{{ asset('./img/banner.jpg') }}" alt="8">
        <img src="/public/img/logos/logo_biit.png" alt="9">
        <img src="public/img/logos/logo_biit.png" alt="10">
        <img src="public/img/logos/logo_biit.png" alt="11">
        <img src="public/img/logos/logo_biit.png" alt="12">
        {{ asset('img/logos/logo_biit.png') }}

        <h1 class="col-10">{{ config('app.name') }}</h1>
    </header>
    <main>
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
