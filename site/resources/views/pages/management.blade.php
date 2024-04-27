@extends('layouts.main')

@section('title', 'Management')
@section('content')

    @include('components.navigationHome')

    <main class="plomesalmarContact">
        @include('components.asideManagement')
        <!-- Plomes al mar Contact Section -->
        <section id="logo" class="row">
            <article class="box__logo">
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                    </a>
                </span>
            </article>
        </section>
    </main>
@endsection

{{-- @push('scripts')
    <script type="module" src="{{ asset('js/pages/plomesalmarContact.js') }}" defer></script>
@endpush --}}
