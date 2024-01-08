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

            <div value-text="biitHeader" class="box__title"></div>
            <p value-text="biitSubheader" class="box__content"></p>
            <a href="{{ route('whyBiit') }}" class="box__button" value-text="aboutButton"></a>
    </div>
    </div>
    </section>
    </div>
    <script type="module" src="{{ asset('js/whyBiit.js') }}" defer></script>
@endsection
