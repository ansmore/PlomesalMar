@extends('layouts.main')

@section('title', 'Species')
@section('content')



    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @include('components.aside')
    <main class="species">
        <section id="head" class="row">
            <article class="box">
                @include('partials.species_table', ['species' => $species])
            </article>
        </section>
        @include('modals.modalLogin')
        @include('modals.modalTeam')
    </main>
@endsection

@push('script')
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
@endpush