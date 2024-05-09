@extends('layouts.main')

@section('title', 'Species')
@section('content')

    <main class="management" data-view="species">
        @include('components.asideManagement')
        <section id="head" class="row">
            <article class="box">
                <h1 class="box__title" data-text="speciesList"></h1>
            </article>
            <article class="box__table">
                <figure class="box__search">
                    @include('components.search')
                    <button type="button" class="button" data-bs-toggle="modal" data-bs-target="createSpecies">
                        <i class="fas fa-plus-circle"></i>
                        <span data-text="addButton"></span>
                    </button>
                </figure>
                @include('partials.speciesTable', ['species' => $species])
            </article>
        </section>
        @include('modals.species.create')
        @include('components.message')
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/management.js') }}" defer></script>
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
    <script type="module" src="{{ asset('js/components/mesage.js') }}" defer></script>
@endpush
