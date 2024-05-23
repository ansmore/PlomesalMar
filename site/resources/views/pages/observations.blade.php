@extends('layouts.main')

@section('title', 'Observations')
@section('content')

    <main class="management" data-view="observations">
        @include('components.asideMenu')
        <section id="head" class="row">
            <article class="box">
                <h1 class="box__title" data-text="observationsList"></h1>
            </article>
            <article class="box__table">
                <div class="box__search">
                    @include('components.search')
                    <a href="{{ route('observations.create', app()->getLocale()) }}" class="form__button__success">
                        <i class="fas fa-plus-circle"></i>
                        <span data-text="addButton"></span>
                    </a>
                </div>
                @include('partials.observationsTable', ['observations' => $observations])
            </article>
        </section>
        @include('components.message')
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/management.js') }}" defer></script>
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
    <script type="module" src="{{ asset('js/components/message.js') }}" defer></script>
@endpush
