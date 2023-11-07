@extends('layouts.main')

@section('title', 'Digitalización')
@section('content')

    <body class="main">
        <p id="descriptionDigitalizacion"></p>
        <h1 id="titleNuevo"></h1>
    </body>

    <script type="module" src="{{ asset('js/digitalizacion.js') }}"></script>
@endsection
