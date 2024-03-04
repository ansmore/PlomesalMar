@extends('layouts.main')

@section('title', 'Biit Modules')
@section('content')

    @include('components.navigationBiit')

    <div class="main">

        <!-- Biit Modulos Section -->
        <section id="management" class="biitModules">
            <div class="biitModules__row">
                <div class="box">
                    <h3 value-text="gestionHeading" class="box__subtitle"></h3>
                    <p value-text="gestionSubeading" class="box__content"></p>
                </div>
                <div class="box">
                    <img src="{{ asset('./img/biit/gestion.png') }}" class="box__image" alt="banner">
                </div>
            </div>
        </section>
        <section id="trade" class="biitModules">
            <div class="biitModules__row">
                <div class="box">
                    <h3 value-text="comercioHeading" class="box__subtitle"></h3>
                    <p value-text="comercioSubeading" class="box__content"></p>
                </div>
                <div class="box">
                    <img src="{{ asset('img/biit/ecommerce.png') }}" class="box__image" alt="banner">
                </div>
            </div>
        </section>
        <section id="process" class="biitModules">
            <div class="biitModules__row">
                <div class="box">
                    <h3 value-text="procesosHeading" class="box__subtitle"></h3>
                    <p value-text="procesosSubeading" class="box__content"></p>
                </div>
                <div class="box">
                    <img src="{{ asset('img/biit/procesos.png') }}" class="box__image" alt="banner">
                </div>
            </div>
        </section>
        <section id="bill" class="biitModules">
            <div class="biitModules__row">
                <div class="box">
                    <h3 value-text="facturaHeading" class="box__subtitle"></h3>
                    <p value-text="facturaSubeading" class="box__content"></p>
                </div>
                <div class="box">
                    <img src="{{ asset('img/biit/facturacion.png') }}" class="box__image" alt="banner">
                </div>
            </div>
        </section>
        <section id="business" class="biitModules">
            <div class="biitModules__row">
                <div class="box">
                    <h3 value-text="businessHeading" class="box__subtitle"></h3>
                    <p value-text="businessSubeading" class="box__content"></p>
                </div>
                <div class="box">
                    <img src="{{ asset('img/biit/gestion.png') }}" class="box__image" alt="banner">
                </div>
            </div>
        </section>
    </div>
    @include('components.footerBiit')
    <script type="module" src="{{ asset('js/biitModules.js') }}" defer></script>
@endsection
