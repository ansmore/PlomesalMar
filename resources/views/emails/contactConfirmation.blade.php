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
            <img src="{{ asset('images/logos/logo_biit.png') }}" alt="logo">
        </figure>
        <h1 class="col-10">{{ config('app.name') }}</h1>
    </header>
    <main>
        <h2>Gracias por ponerte en contacto con nosotros</h2>
        <p class="cursiva">Tu mensaje ha sido recibido correctamente.</p>
        <p>Detalles del mensaje:</p>
        <ul>
            <li>Asunto: {{ $messages->mailsubject }}</li>
            <li>Nombre: {{ $messages->name }}</li>
            <li>Correo electrónico: <a href="mailto:{{ $messages->email }}">&lt;{{ $messages->email }}&gt;</a></li>
            <li>Mensaje: {{ $messages->message }}</li>
        </ul>
        <p>Agradecemos tu interés en {{ config('app.name') }}. Hemos recibido tu solicitud y nos pondremos en contacto
            contigo en un plazo de 72 horas laborables.</p>
        <p>Mientras tanto, si tienes alguna pregunta adicional, no dudes en contactarnos.</p>
    </main>
    <footer class="mail-footer bg-light">
        <p>pymesoft web </p>
    </footer>
</body>

</html>
