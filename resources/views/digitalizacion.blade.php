
@extends('layouts.master')

@section('titulo', 'Digitalización')
@section('components')
    <!-- <body> -->
        <main>

            <p id="descriptionDigitalizacion"></p>
            <h1 id="titleNuevo"></h1>

        </main>
<script type="modude" src="{{asset('js/helpers/dictionary.js')}}"></script>
<script type="modude" src="{{asset('js/digitalizacion.js')}}"></script>
<!-- 
        <button id="buttonHello"></button>
        <script type="module" src="{{ asset('js/helpers/dictionary.js') }}"></script>
        <script type="module" src="{{ asset('js/digitalizacion.js') }}"></script>
    </body> -->
@endseection
