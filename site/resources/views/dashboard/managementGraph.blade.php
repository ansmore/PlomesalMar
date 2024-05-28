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
                <h1 class="box__title" data-text="graphList"></h1>
            </article>
            <article class="box__logo">
                <a href="{{ route('dashboard.graph1', ['language' => $language]) }}">
                    <figure class="box__logo__image">
                        <i class="fas fa-chart-column"></i>
                        <span data-text="graph1"></span>
                    </figure>
                </a>
                <a href="{{ route('dashboard.graph1', ['language' => $language]) }}">
                    <figure class="box__logo__image">
                        <i class="fas fa-chart-line"></i>
                        <span data-text="graph2"></span>
                    </figure>
                </a>
                <a href="{{ route('dashboard.graph1', ['language' => $language]) }}">
                    <figure class="box__logo__image">
                        <i class="fas fa-chart-pie"></i>
                        <span data-text="graph3"></span>
                    </figure>
                </a>
            </article>
        </section>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/management.js') }}" defer></script>
@endpush
