@extends('layouts.main')

@section('title', 'Home')
@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="home">
        <section id="solutions" class="row">
            <article class="box">
                <h1 class="box__title" data-text="homeTitle"></h1>
            </article>
            <article class="box__circle">
                <a href="{{ route('management', ['language' => $language]) }}">
                    <figure class="circle modal-button">
                        <span class="circle__icon">
                            <i class="fa-solid fa-table"></i>
                        </span>
                        <h4 class="circle__content" data-text="assCetacea">
                        </h4>
                    </figure>
                </a>
                <a href="{{ route('species', ['language' => $language]) }}">
                    <figure class="circle modal-button">
                        <span class="circle__icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </span>
                        <h4 class="circle__content" data-text="homeTitle">
                        </h4>
                    </figure>
                </a>
            </article>
        </section>
        <section id="about" class="row--reverse">
            <article class="box">
                <h2 class="box__title" data-text="aboutHeading"></h2>
            </article>
            <article class="box">
                <span class="box__content" data-text="aboutText"></span>
                <a href="{{ route('home', ['language' => $language]) }}" class="box__button" data-text="aboutButton"></a>
            </article>
            <article class="box">
                <figure class="box__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        {{-- <img src="{{ asset('img/logos/banner.jpg') }}" alt="banner"> --}}
                    </a>
                </figure>
            </article>
        </section>
        <section class="row">
            <article class="box__circle">
                <figure class="circle modal-button" data-modal-id="secondModal">
                    {{-- <a href="{{ route('home', ['language' => $language]) }}"> --}}
                    <span class="circle__icon">
                        <i class="fa-solid fa-table"></i>
                    </span>
                    <h4 class="circle__content" data-text="assCetacea">
                    </h4>
                    {{-- </a> --}}
                </figure>
                <figure class="circle modal-button" data-modal-id="thirdModal">
                    {{-- <a href="{{ route('home', ['language' => $language]) }}"> --}}
                    <span class="circle__icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </span>
                    <h4 class="circle__content" data-text="homeTitle">
                    </h4>
                    {{-- </a> --}}
                </figure>
            </article>
        </section>
        @include('modals.modalLogin')
        @include('modals.modalTeam')
    </main>
    @include('components.footer')
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/home.js') }}" defer></script>
@endpush
