@extends('layouts.main')

@section('title', 'Management')
@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="management">
        @include('components.asideManagement')
        <!-- Plomes al mar Contact Section -->
        <section id="logo" class="row">
            <article class="box__logo">
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <i class="fas fa-globe">
                        </i>
                        <span data-text="asideDeparture"></span>
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <i class="fas fa-binoculars">
                        </i>
                        <span data-text="asideObservation"></span>
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('species', ['language' => $language]) }}">
                        <i class="fas fa-crow">
                        </i>
                        <span data-text="asideSpecie"></span>
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <i class="fas fa-ship">
                        </i>
                        <span data-text="asideBoat"></span>
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <i class="fas fa-location">
                        </i>
                        <span data-text="asideTransect"></span>
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <i class="fas fa-camera">
                        </i>
                        <span data-text="asideImage"></span>
                    </a>
                </span>
            </article>
        </section>
    </main>
@endsection

{{-- @push('scripts')
    <script type="module" src="{{ asset('js/pages/plomesalmarContact.js') }}" defer></script>
@endpush --}}
