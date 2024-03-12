@extends('layouts.main')

@section('title', 'Biit Modules')
@section('content')

    @include('components.navigationBiit')

    <main class="biitModules">

        <!-- Biit Modulos Section -->
        <section id="management" class="biitModules__row">
            <article class="box">
                <h3 value-text="managementHeading" class="box__subtitle"></h3>
                <span value-text="managementSubheading" class="box__content"></span>
                <p value-text="managementSubheadingSecondary" class="box__subtitle__secondary">
                </p>
                <ul>
                    <li>
                        <span value-text="management1" class="box__content"></span>
                    </li>
                    <li>
                        <span value-text="management2" class="box__content"></span>
                    </li>
                    <li>
                        <span value-text="management3" class="box__content"></span>
                    </li>
                    <li>
                        <span value-text="management4" class="box__content"></span>
                    </li>
                    <li>
                        <span value-text="management5" class="box__content"></span>
                    </li>
                </ul>
                <p>

                <p value-text="management6" class="box__content"></p>
                <p value-text="management7" class="box__content"></p>
                </p>
                <figure class="box">
                    <img src="{{ asset('./img/biit/gestion.png') }}" class="box__image" alt="banner">
                </figure>
            </article>
        </section>
        <section id="trade" class="biitModules__row">
            <article class="box">
                <h3 value-text="comercioHeading" class="box__subtitle"></h3>
                <p value-text="comercioSubheading" class="box__content"></p>
                <figure class="box">
                    <img src="{{ asset('img/biit/ecommerce.png') }}" class="box__image" alt="banner">
                </figure>
            </article>
        </section>
        <section id="process" class="biitModules__row">
            <article class="box">
                <h3 value-text="procesosHeading" class="box__subtitle"></h3>
                <p value-text="procesosSubheading" class="box__content"></p>
                <figure class="box">
                    <img src="{{ asset('img/biit/procesos.png') }}" class="box__image" alt="banner">
                </figure>
            </article>
        </section>
        <section id="bill" class="biitModules__row">
            <article class="box">
                <h3 value-text="facturaHeading" class="box__subtitle"></h3>
                <p value-text="facturaSubheading" class="box__content"></p>
                <figure class="box">
                    <img src="{{ asset('img/biit/facturacion.png') }}" class="box__image" alt="banner">
                </figure>
            </article>
        </section>
        <section id="business" class="biitModules__row">
            <article class="box">
                <h3 value-text="businessHeading" class="box__subtitle"></h3>
                <p value-text="businessSubheading" class="box__content"></p>
                <figure class="box">
                    <img src="{{ asset('img/biit/gestion.png') }}" class="box__image" alt="banner">
                </figure>
            </article>
        </section>
        @include('components.footerBiit')
    </main>
    <script type="module" src="{{ asset('js/biitModules.js') }}" defer></script>
@endsection
