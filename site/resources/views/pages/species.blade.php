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
                <h2>Aqui species</h2>
            </article>
        </section>
        @include('modals.modalLogin')
        @include('modals.modalTeam')
    </main>
    <script type="module" src="{{ asset('js/pages/home.js') }}" defer></script>
@endsection
