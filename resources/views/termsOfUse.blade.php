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
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('img/logos/pymesoft_logo_image.png') }}" alt="">
                        </a>
                    </span>
                    <span class="circle__image">
                        <a href="{{ route('biit') }}">
                            <img src="{{ asset('img/logos/logo_biit.png') }}" alt="">
                        </a>
                    </span>
                </div>
            </div>
        </section>
        <section class="termsAndPolicy">
            <div class="termsAndPolicy__row">
                <h2 value-text="termsHeader" class="box__title"></h2>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="termsIntroA" class="box__content"></span>
                </article>

            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroBTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsName" class="box__name"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroCTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsIntroC" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroDTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsIntroD" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroETitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsIntroE" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroFTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsIntroF" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroGTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsIntroG" class="box__company"></span>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>
    <script type="module" src="{{ asset('js/whyBiit.js') }}" defer></script>
@endsection
