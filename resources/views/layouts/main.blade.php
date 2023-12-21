<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <title>{{ config('app.name') }} - @yield('title')</title>
</head>

<body>
    <div class="content">
        @yield('content')
    </div>
    @include('components.footer')
</body>

</html>
