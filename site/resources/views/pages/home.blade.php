@extends('layouts.main')

@section('title', 'Home')
@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <main class="home">
        <section id="solutions" class="row">
            <article class="box">
                <h1 class="box__title" data-text="homeTitle"></h1>
            </article>
            <article class="box__circle">
                <figure class="circle modal-button">
                    <a href="{{ route('management', ['language' => $language]) }}">
                        <span class="circle__icon">
                            <i class="fa-solid fa-table"></i>
                        </span>
                        <h4 class="circle__content" data-text="homeManagement">
                        </h4>
                    </a>
                </figure>
                <a href="{{ route('dashboard.management', ['language' => $language]) }}">
                    <figure class="circle modal-button">
                        <span class="circle__icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </span>
                        <h4 class="circle__content" data-text="homeDashboard">
                        </h4>
                    </figure>
                </a>
            </article>
        </section>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/home.js') }}" defer></script>
@endpush
