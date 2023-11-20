@extends('layouts.main')

@section('title', 'Digitalización')
@section('content')

    @include('components.navigationDigitalizacion')

    <body class="main">
        <h1 id="titleNuevo"></h1>
        <p id="descriptionDigitalizacion"></p>
    </body>

    <script type="module" src="{{ asset('js/digitalizacion.js') }}"></script>
@endsection
