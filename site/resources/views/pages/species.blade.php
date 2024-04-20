@extends('layouts.main')

@section('title', 'Species')
@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="species">
        @include('components.aside')
        <section id="head" class="row">
            <article class="box">
                @include('partials.species_table', ['species' => $species])
            </article>
        </section>
        @include('modals.modalLogin')
        @include('modals.modalTeam')
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
@endpush
