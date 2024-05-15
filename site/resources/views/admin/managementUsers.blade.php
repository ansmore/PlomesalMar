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
                <h1 class="box__title" data-text="listTables"></h1>
            </article>
            <article class="box__logo">
                <a href="{{ route('admin.users', ['language' => $language]) }}">
                    <figure class="box__logo__image">
                        <i class="fas fa-users"></i>
                        <span data-text="users"></span>
                    </figure>
                </a>
            </article>
        </section>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/management.js') }}" defer></script>
@endpush
