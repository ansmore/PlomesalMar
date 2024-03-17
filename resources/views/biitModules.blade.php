@extends('layouts.main')

@section('title', 'Biit Modules')
@section('content')

    @include('components.navigationBiit')

    <main class="biitModules">
        <!-- Biit Modulos Section -->
        <section id="management" class="row">
            <article class="box">
                <h2 value-text="managementHeading" class="box__subtitle"></h2>
                <p>
                    <span value-text="managementSubheading" class="box__content"></span>
                </p>
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
                    <span value-text="management6" class="box__content"></span>
                </p>
                <p>
                    <span value-text="management7" class="box__content"></span>
                </p>
                {{-- Here-> Pending update class to photo gallery --}}
                <figure>
                    <img src="{{ asset('./img/biit/gestion.png') }}" class="box__image" alt="banner">
                </figure>
            </article>
        </section>
        <section id="trade" class="row">
            <article class="box">
                <h2 value-text="comercioHeading" class="box__subtitle"></h2>
                <p>
                    <span value-text="comercioSubheading" class="box__content"></span>
                </p>
                <figure>
                    <img src="{{ asset('img/biit/ecommerce.png') }}" class="box__image" alt="banner">
                </figure>
            </article>
        </section>
        <section id="process" class="row">
            <article class="box">
                <h2 value-text="procesosHeading" class="box__subtitle"></h2>
                <p>
                    <span value-text="procesosSubheading" class="box__content"></span>
                </p>
                <figure>
                    <img src="{{ asset('img/biit/procesos.png') }}" class="box__image" alt="banner">
                </figure>
            </article>
        </section>
        <section id="bill" class="row">
            <article class="box">
                <h2 value-text="facturaHeading" class="box__subtitle"></h2>
                <p>
                    <span value-text="facturaSubheading" class="box__content"></span>
                </p>
                <figure>
                    <img src="{{ asset('img/biit/facturacion.png') }}" class="box__image" alt="banner">
                </figure>
            </article>
        </section>
        <section id="business" class="row">
            <article class="box">
                <h2 value-text="businessHeading" class="box__subtitle"></h2>
                <p>
                    <span value-text="businessSubheading" class="box__content"></span>
                </p>
                <figure>
                    <img src="{{ asset('img/biit/gestion.png') }}" class="box__image" alt="banner">
                </figure>
            </article>
        </section>
        @include('components.footerBiit')
    </main>
    <script type="module" src="{{ asset('js/biitModules.js') }}" defer></script>
@endsection
