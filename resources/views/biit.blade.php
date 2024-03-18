@extends('layouts.main')

@section('title', 'Biit')
@section('content')

    @include('components.navigationBiit')

    <main class="biit">
        <!-- Header  section -->
        <section id="header__biit" class="header">
            <div class="header__row">
                <div class="box">
                    <span class="box__image">
                        <img src="{{ asset('img/logos/logo_biit.png') }}" alt="">
                    </span>

                    <h2 value-text="biitHeader" class="box__title"></h2>
                    <p value-text="biitSubheader" class="box__content"></p>
                    <a href="{{ route('whyBiit', ['language' => $language]) }}" class="box__button"
                        value-text="aboutButton"></a>
                </div>
            </div>
        </section>
    </main>
    <script type="module" src="{{ asset('js/biit.js') }}" defer></script>
@endsection
