<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <title>{{ config('app.name') }} - @yield('title')</title>
</head>

<body>
    @include('components.navigation')
    @include('components.header')
    <div class="content">
        @yield('content')
    </div>
</body>

</html>
