@extends('layouts.main')

@section('title', 'Management')
@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="management">
        @include('components.asideMenu')
        <!-- Plomes al mar Contact Section -->
        <section id="logo" class="row">
            <article class="box">
                <h1 class="box__title" data-text="listTables"></h1>
            </article>
            <article class="box__logo">
                <a href="{{ route('departures', ['language' => $language]) }}">
                    <figure class="box__logo__image">
                        <i class="fas fa-globe"></i>
                        <span data-text="asideDeparture"></span>
                    </figure>
                </a>
                <a href="{{ route('home', ['language' => $language]) }}">
                    <figure class="box__logo__image">
                        <i class="fas fa-binoculars">
                        </i>
                        <span data-text="asideObservation"></span>
                    </figure>
                </a>
                <a href="{{ route('species', ['language' => $language]) }}">
                    <figure class="box__logo__image">
                        <i class="fas fa-crow">
                        </i>
                        <span data-text="asideSpecie"></span>
                    </figure>
                </a>
                <a href="{{ route('boats', ['language' => $language]) }}">
                    <figure class="box__logo__image">
                        <i class="fas fa-ship">
                        </i>
                        <span data-text="asideBoat"></span>
                    </figure>
                </a>
                <a href="{{ route('transects', ['language' => $language]) }}">
                    <figure class="box__logo__image">
                        <i class="fas fa-location">
                        </i>
                        <span data-text="asideTransect"></span>
                    </figure>
                </a>
                {{-- <a href="{{ route('home', ['language' => $language]) }}">
                    <figure class="box__logo__image">
                        <i class="fas fa-camera">
                        </i>
                        <span data-text="asideImage"></span>
                    </figure>
                </a> --}}
            </article>
        </section>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/management.js') }}" defer></script>
@endpush
