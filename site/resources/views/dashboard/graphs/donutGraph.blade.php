@extends('layouts.main')

@section('title', 'Dashboard')
@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="management">
        @include('components.asideMenu')

        <section id="logo" class="row">
            @include('partials.donutGraph1')
        </section>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="{{ asset('js/partials/donutGraph.js') }}" defer></script>
@endpush
