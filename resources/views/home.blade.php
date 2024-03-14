@extends('layouts.main')

@section('title', 'Home')
@section('content')

    @include('components.navigationHome')
    {{-- @include('components.header') --}}

    <main class="home">

        <section id="solutions" class="row solutions">

            <article class="box">
                <h2 class="box__title" value-text="homeSoluciones"></h2>
                <p>
                    <span class="box__content" value-text="homeIntro"></span>
                    <span class="box__name" value-text="pymesoft"></span>
                    <span class="box__content" value-text="homeIntro2"></span>
                </p>
                <p>
                    <span class="box__content" value-text="homeIntro3"></span>
                    <span class="box__name" value-text="pymesoft"></span>
                    <span class="box__content" value-text="homeIntro4"></span>
                </p>
                <p>
                    <span class="box__content" value-text="homeIntro5"></span>
                </p>
                <p>
                    <span class="box__content" value-text="homeIntro6"></span>
                    <span class="box__name" value-text="pymesoft"></span>
                    <span class="box__content" value-text="homeIntro7"></span>
                </p>
            </article>
            <article class="box">
                <figure class="circle">
                    <span class="circle__icon">
                        <span class="i">
                            <img src="{{ asset('img/logos/logo_biit.png') }}" alt="">
                        </span>
                    </span>
                    <h4 class="circle__content">
                        <a href="{{ route('biit', ['language' => $language]) }}" value-text="services1"></a>
                    </h4>
                </figure>
                <figure class="circle">
                    <span class="circle__icon">
                        <span class="i">
                            <img src="{{ asset('img/logos/sage.svg') }}" alt="">
                        </span>
                    </span>
                    <h4 class="circle__content">
                        <a href="{{ route('consultancy', ['language' => $language]) }}" value-text="services3"></a>
                    </h4>
                </figure>
                {{-- </div> --}}
            </article>
        </section>

        <!-- About Section -->
        <section id="about" class="about">
            <article class="box">
                <h2 class="box__title" value-text="aboutHeading"></h2>
                <p>
                    <span class="box__content" value-text="aboutText"></span>
                    <a href="{{ route('biit', ['language' => $language]) }}" class="box__button"
                        value-text="aboutButton"></a>
                </p>
                <figure>
                    <a href="{{ route('biit', ['language' => $language]) }}">
                        <img src="{{ asset('img/logos/banner.jpg') }}" alt="banner">
                    </a>
                </figure>
            </article>
        </section>

        <!-- Sitemap & Contact Section -->
        <!-- Contact-Custom -->
        <section id="contact" class="row">

            <article class="box">
                <h2 class="box__title" value-text="sitemapHeading"></h2>
                <span class="box__content">
                    <i class="fa fa-map-marker"></i>
                    <p value-text="sitemapAddress"></p>
                </span>
            </article>

            <article class="contact__row" id="overlay"> <!-- Obtener clave API -->
                <iframe class="box__map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2984.8365965213275!2d2.079309315088584!3d41.572780979247604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a494c6bf0218b9%3A0xfb5a922369909333!2sPymesoft+Vall%C3%A9s+S.L.!5e0!3m2!1ses!2ses!4v1515689921450"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
            </article>

            <article class="box">
                <h2 class="box__title" value-text="contactHeading"></h2>
                <p>
                    <span class="box__content" value-text="contactPhone">
                    </span>
                    <span class="box__content" value-text="contactPhoneNumber">
                    </span>

                </p>
                <p>
                    <span class="box__content" value-text="contactAction"></span>
                    <a href="{{ route('biitContact', ['language' => $language]) }}" class="box__button"
                        value-text="contactActionMessage"></a>
                </p>
            </article>

        </section>
    </main>
    <script type="module" src="{{ asset('js/home.js') }}" defer></script>
@endsection
