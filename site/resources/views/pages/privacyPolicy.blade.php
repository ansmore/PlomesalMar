@extends('layouts.main')

@section('title', 'Privacy Policy')
@section('content')

    @include('components.navigationHome')

    <div class="main">
        <!-- Header  section -->
        <section id="header__birds" class="termsAndPolicy">
            <div class="termsAndPolicy__row">
                <div class="circles">
                    <span class="circles__pyme">
                        <a href="{{ route('home', ['language' => $language]) }}">
                            <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                        </a>
                    </span>
                    <span class="circles__birds">
                        <a href="{{ route('home', ['language' => $language]) }}">
                            <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                        </a>
                    </span>
                </div>
            </div>
        </section>
        <section class="termsAndPolicy">
            <div class="termsAndPolicy__row">
                <h2 data-text="politicaHeader" class="box__title"></h2>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p>
                        <span data-text="politica1A" class="box__content"></span>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politica1B" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politica2" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politica3A" class="box__content"></span>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politica3B" class="box__content"></span><span data-text="politicaName"
                            class="box__name"></span>
                        <span data-text="politica3C" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politica4" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politica5A" class="box__content"></span>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politica5B" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politica6" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politica7" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politica8" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politica9" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="politicaConfidencialidadHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="politicaConfidencialidadA" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politicaConfidencialidadB" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="politicaAceptacionHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="politicaAceptacionA" class="box__content"></span>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politicaAceptacionB" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politicaAceptacionC" class="box__content"></span>
                        <span data-text="politicaName" class="box__name"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="politicaExactitudHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="politicaExactitudA" class="box__content"></span>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politicaExactitudB" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="politicaContenidoHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politicaContenidoA" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politicaContenidoB" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politicaContenidoC" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="politicaEnvioCVHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="politicaEnvioCVA" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politicaEnvioCVB" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="politicaEnvioCVC" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="politicaCambiosHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politicaCambiosA" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="politicaCorreosHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="politicaCorreosA" class="box__content"></span>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politicaCorreosB" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="politicaLegislacionHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="politicaLegislacionA" class="box__content"></span>
                        <span data-text="politicaName" class="box__name"></span>
                        <span data-text="politicaLegislacionB" class="box__content"></span>
                    </p>
                </article>
            </div>
        </section>
    </div>
    <script type="module" src="{{ asset('js/pages/termsAndPolicy.js') }}" defer></script>
@endsection
