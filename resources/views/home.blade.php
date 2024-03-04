@extends('layouts.main')

@section('title', 'Home')
@section('content')

    @include('components.navigationHome')
    {{-- @include('components.header') --}}

    <div class="main">
        <!-- Services Section -->
        <section id="soluciones" class="solutions">
            <div class="solutions__row--title">
                <div class="box">
                    <span class="box__image">
                        <img src="{{ asset('../img/logos/pymesoft_logo_text.png') }}" alt="">
                    </span>
                    <h2 class="box__title" value-text="homeSoluciones"></h2>
                    <h3 class="box__content" value-text="homeServicesSubheading"></h3>
                </div>
            </div>
            <div class="solutions__row--content">
                <div class="circle">
                    {{-- box--content --}}
                    <span class="circle__icon">
                        <span class="i">
                            {{-- <i class="fa  fa-check-square"></i> --}}
                            <img src="{{ asset('img/logos/logo_biit.png') }}" alt="">
                        </span>
                    </span>
                    <h4 class="circle__content">
                        <a href="{{ route('biit', ['language' => $language]) }}" value-text="services1"></a>
                    </h4>
                </div>
                <div class="circle">
                    {{-- box--content --}}
                    <span class="circle__icon">
                        <span class="i">
                            {{-- <i class="fa fa-list-ul"></i> --}}
                            <img src="{{ asset('img/logos/sage.svg') }}" alt="">
                        </span>
                    </span>
                    <h4 class="circle__content">
                        <a href="{{ route('consultancy', ['language' => $language]) }}" value-text="services3"></a>
                    </h4>
                </div>
            </div>
        </section>
        <!-- Clients Aside -->
        {{-- <section class="aside">
            <div class="aside__box">
                <a href="{{ route('biit', ['language' => $language]) }}">
                    <img src="{{ asset('img/logos/banner.jpg') }}" alt="banner">
                </a>
            </div>
        </section> --}}
        <!-- About Section -->
        <section id="about" class="about">
            <div class="about__row">
                <div class="box">
                    <h2 class="box__title" value-text="aboutHeading"></h2>
                    <h4 class="box__content" value-text="aboutText"></h4>
                    <a href="{{ route('biit', ['language' => $language]) }}" class="box__button"
                        value-text="aboutButton"></a>
                </div>
            </div>
            <div class="aside__box">
                <a href="{{ route('biit', ['language' => $language]) }}">
                    <img src="{{ asset('img/logos/banner.jpg') }}" alt="banner">
                </a>
            </div>
        </section>

        <!-- Sitemap & Contact Section -->
        <!-- Contact-Custom -->
        <section id="contact" class="contact">
            <div class="contact__row">
                <div class="box--title">
                    <h2 class="box__title" value-text="sitemapHeading"></h2>
                    <h3 class="box__content">
                        <i class="fa fa-map-marker"></i>
                        <p value-text="sitemapAddress"></p>
                    </h3>
                </div>
            </div>
            <div class="contact__row" id="overlay"> <!-- Obtener clave API -->
                <iframe class="box__map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2984.8365965213275!2d2.079309315088584!3d41.572780979247604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a494c6bf0218b9%3A0xfb5a922369909333!2sPymesoft+Vall%C3%A9s+S.L.!5e0!3m2!1ses!2ses!4v1515689921450"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="contact_row">
                <div class="box">
                    <h2 class="box__title" value-text="contactHeading"></h2>
                </div>
                <div class="box">
                    <h3 class="box__content" value-text="contactPhone">
                    </h3>
                    <h4 class="box__content" value-text="contactPhoneNumber">
                    </h4>
                    {{-- <span class="box__icon"> </span> --}}
                </div>
                <div class="box">
                    <h3 class="box__content" value-text="contactAction"></h3>
                    <a href="{{ route('biitContact', ['language' => $language]) }}" class="box__button"
                        value-text="contactActionMessage"></a>
                </div>
            </div>
    </div>
    </section>
    </div>
    <script type="module" src="{{ asset('js/home.js') }}" defer></script>
@endsection
