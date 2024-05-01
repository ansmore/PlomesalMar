@extends('layouts.main')

@section('title', 'Species')
@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="species">
        @include('components.asideManagement')
        <section id="head" class="row">
            <article class="box">
                <h1 class="box__title">Lista de Especies</h1>
            </article>
            <article class="box__search">
                @include('components.search')
                <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#createSpecies">
                    <i class="fas fa-plus-circle"></i> Añadir
                </button>
            </article>
            <article class="box">
                @include('partials.speciesTable', ['species' => $species])
            </article>
        </section>
        @include('modals.species.create')
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
    <script type="module" src="{{ asset('js/helpers/pagination.js') }}" defer></script>
@endpush
