@extends('layouts.main')

@section('title', 'Home')
@section('content')

    @include('components.navigationHome')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="home">
        <section id="solutions" class="row">
            <article class="box">
                <h2 class="box__title" data-text="homeTitle"></h2>
                <p>
                    <span class="box__content--reverse" data-text="homeIntro"></span>
                    <span class="box__name--reverse" data-text="assCetacea"></span>
                    <span class="box__content--reverse" data-text="homeIntro2"></span>
                </p>
                <p>
                    <span class="box__content--reverse" data-text="homeIntro3"></span>
                    <span class="box__name--reverse" data-text="plomesalamar"></span>
                    <span class="box__content--reverse" data-text="homeIntro4"></span>
                </p>
            </article>
            <article class="box__circle">
                <figure class="circle modal-button" data-modal-id="secondModal"">
                    {{-- <a href="{{ route('home', ['language' => $language]) }}"> --}}
                    <span class="circle__icon">
                        <img src="{{ asset('img/logos/logo_blue.jpeg') }}" alt="">
                    </span>
                    <h4 class="circle__content" data-text="assCetacea">
                    </h4>
                    {{-- </a> --}}
                </figure>
                <figure class="circle modal-button" data-modal-id="thirdModal">
                    {{-- <a href="{{ route('home', ['language' => $language]) }}"> --}}
                    <span class="circle__icon">
                        <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                    </span>
                    <h4 class="circle__content" data-text="homeTitle">
                    </h4>
                    {{-- </a> --}}
                </figure>
            </article>
        </section>
        <section id="about" class="row--reverse">
            <article class="box">
                <h2 class="box__title" data-text="aboutHeading"></h2>
            </article>
            <article class="box">
                <span class="box__content" data-text="aboutText"></span>
                <a href="{{ route('home', ['language' => $language]) }}" class="box__button" data-text="aboutButton"></a>
            </article>
            <article class="box">
                <figure class="box__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        {{-- <img src="{{ asset('img/logos/banner.jpg') }}" alt="banner"> --}}
                    </a>
                </figure>
            </article>
        </section>
        <section id="contact" class="row">
            <article class="box">
                <h2 class="box__title" data-text="sitemapHeading"></h2>
                <span class="box__content">
                    <i class="fa fa-map-marker"></i>
                </span>
                <span class="box__content" data-text="sitemapAddress"></span>
            </article>
            {{-- <article class="box" id="overlay"> <!-- Obtener clave API -->
                <iframe class="box__map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2984.8365965213275!2d2.079309315088584!3d41.572780979247604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a494c6bf0218b9%3A0xfb5a922369909333!2sPymesoft+Vall%C3%A9s+S.L.!5e0!3m2!1ses!2ses!4v1515689921450"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
            </article> --}}
            <article class="box">
                <h2 class="box__title" data-text="contactHeading"></h2>
                <span class="box__row">
                    <span class="box__content" data-text="contactPhone">
                    </span>
                    <span class="box__content" data-text="contactPhoneNumber">
                    </span>
                </span>
                <span class="box__row">
                    <span class="box__content" data-text="contactAction"></span>
                    <a class="box__button" href="{{ route('plomesalmarContact', ['language' => $language]) }}"
                        data-text="contactActionMessage"></a>
                </span>
            </article>
        </section>
        @include('modals.modalLogin')
        @include('modals.modalTeam')
    </main>
    @include('components.footer')
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/home.js') }}" defer></script>
@endpush
