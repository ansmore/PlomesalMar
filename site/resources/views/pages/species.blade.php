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
            <div class="title-and-button">
                <h1 class="display-5" style="color: #004F71; flex-grow: 1;">Lista de Especies</h1>
                <button type="button" class="button-add" data-bs-toggle="modal" data-bs-target="#createSpecies">
                    <i class="fas fa-plus-circle"></i> Añadir
                </button>
            </div>
            <article class="box">
                @include('components.search')
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
