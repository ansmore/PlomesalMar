@extends('layouts.main')

@section('title', 'Inicio')
@section('content')

    <body class="main">
        <h1 id="title"></h1>
        <p id="description"></p>
    </body>

    <script type="module" src="{{ asset('js/home.js') }}"></script>
@endsection
