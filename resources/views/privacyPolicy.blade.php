@extends('layouts.main')

@section('title', 'Biit')
@section('content')

    @include('components.navigationHome')

    <div class="main">
        <!-- Header  section -->
        <section id="header__biit" class="termsAndPolicy">
            <div class="termsAndPolicy__row">
                <div class="circle">
                    <span class="circle__image">
                        <img src="{{ asset('img/logos/pymesoft_logo_image.png') }}" alt="">
                    </span>
                    <span class="circle__image">
                        <img src="{{ asset('img/logos/logo_biit.png') }}" alt="">
                    </span>
                </div>
            </div>
        </section>
        <section class="termsAndPolicy">
            <div class="termsAndPolicy__row">
                <h2 value-text="politicaHeader" class="box__title"></h2>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="politica1A" class="box__content"></span>
                    <span value-text="politicaName" class="box__name"></span>
                    <span value-text="politica1B" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="politicaName" class="box__name"></span>
                    <span value-text="politica2" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="politica3A" class="box__content"></span>
                    <span value-text="politicaName" class="box__name"></span>
                    <span value-text="politica3B" class="box__content"></span><span value-text="politicaName"
                        class="box__name"></span>
                    <span value-text="politica3C" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="politica4" class="box__content"></span>

                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="politica5A" class="box__content"></span>
                    <span value-text="politicaName" class="box__name"></span>
                    <span value-text="politica5B" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="politica6" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="politica7" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="politica8" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="politica9" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="politicaConfidencialidadHeader" class="box__subtitle"></p>
                    <div>
                        <span value-text="politicaConfidencialidadA" class="box__content"></span>
                    </div>
                    <div>
                        <span value-text="politicaName" class="box__name"></span>
                        <span value-text="politicaConfidencialidadB" class="box__content"></span>
                    </div>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="politicaAceptacionHeader" class="box__subtitle"></p>
                    <div>
                        <span value-text="politicaAceptacionA" class="box__content"></span>
                        <span value-text="politicaName" class="box__name"></span>
                        <span value-text="politicaAceptacionB" class="box__content"></span>
                    </div>
                    <div>
                        <span value-text="politicaAceptacionC" class="box__content"></span>
                        <span value-text="politicaName" class="box__name"></span>
                    </div>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="politicaExactitudHeader" class="box__subtitle"></p>
                    <span value-text="politicaExactitudA" class="box__content"></span>
                    <span value-text="politicaName" class="box__name"></span>
                    <span value-text="politicaExactitudB" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="politicaContenidoHeader" class="box__subtitle"></p>
                    <div>
                        <span value-text="politicaName" class="box__name"></span>
                        <span value-text="politicaContenidoA" class="box__content"></span>
                    </div>
                    <div>
                        <span value-text="politicaName" class="box__name"></span>
                        <span value-text="politicaContenidoB" class="box__content"></span>
                    </div>
                    <div>
                        <span value-text="politicaContenidoC" class="box__content"></span>
                    </div>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="politicaEnvioCVHeader" class="box__subtitle"></p>
                    <div>
                        <span value-text="politicaEnvioCVA" class="box__content"></span>
                    </div>
                    <div>
                        <span value-text="politicaEnvioCVB" class="box__content"></span>
                    </div>
                    <div>
                        <span value-text="politicaEnvioCVC" class="box__content"></span>
                    </div>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="politicaCambiosHeader" class="box__subtitle"></p>
                    <span value-text="politicaName" class="box__name"></span>
                    <span value-text="politicaCambiosA" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="politicaCorreosHeader" class="box__subtitle"></p>
                    <span value-text="politicaCorreosA" class="box__content"></span>
                    <span value-text="politicaName" class="box__name"></span>
                    <span value-text="politicaCorreosB" class="box__content"></span>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="politicaLegislacionHeader" class="box__subtitle"></p>
                    <span value-text="politicaLegislacionA" class="box__content"></span>
                    <span value-text="politicaName" class="box__name"></span>
                    <span value-text="politicaLegislacionB" class="box__content"></span>
                </article>
            </div>
    </div>
    </div>
    </section>
    </div>
    <script type="module" src="{{ asset('js/whyBiit.js') }}" defer></script>
@endsection
