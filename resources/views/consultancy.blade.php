@extends('layouts.main')

@section('title', 'Consultancy')
@section('content')

    @include('components.navigationHome')

    <div class="main">

        <!-- Header -->
        <header class="about">
            <div class="about__row">
                <div class="box">
                    <div value-text="consultoriaHeader" class="box__title"></div>
                </div>
            </div>
        </header>

        <!-- Services Section -->
        <section id="consultancy" class="whatIs">
            <div class="whatIs__row">
                <div class="box">
                    <div class="icon">
                        <span class="icon__image">
                            <i class="fa-solid fa-handshake"></i>
                        </span>
                    </div>
                    <h3 value-text="consultoriaServicio" class="box__subtitle"> </h3>
                    <p value-text="consultoriaInformaticos" class="box__content"></p>
                    <p value-text="consultoriaPymesoft" class="box__content"></p>
                </div>
                <div class="box">
                    <div class="icon">
                        <span class="icon__image">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                        </span>
                    </div>
                    <h3 value-text="consultoriaSoftware" class="box__subtitle"></h3>
                    <p value-text="consultoriaGamaSage" class="box__content"></p>
                    <p value-text="consultoriaSage" class="box__content"></p>
                    <p value-text="consultoriaNecesidades" class="box__content"></p>
                    <p value-text="consultoriaAplicaciones" class="box__content"></p>
                </div>
                <div class="box">
                    <div class="icon">
                        <span class="icon__image">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                    </div>
                    <h3 value-text="consultoriaFormacion" class="box__subtitle"></h3>
                    <p value-text="consultoriaFormaconText" class="box__content"></p>
                    <p value-text="consultoriaAulas" class="box__content"></p>
                </div>
            </div>
        </section>
    </div>
    <script type="module" src="{{ asset('js/digitalization.js') }}" defer></script>
@endsection
