@extends('layouts.main')

@section('title', 'Species')
@section('content')

    <main class="management">
        @include('components.asideMenu')
        <section id="head" class="row">
            <article class="box">
                <h1 class="box__title" data-text="usersList"></h1>
            </article>
            <article class="box">
                <div class="box__next">
                    <a href="{{ route('admin.users', [
                        'language' => $language,
                    ]) }}"
                        class="form__button__success">
                        <i class="fas fa-plus-circle"></i>
                        <span data-text="addButton"></span>
                    </a>
                </div>
            </article>
            {{-- <article class="box__table">
                <div class="box__search">
                    @include('components.search')
                    <button type="button" class="button" data-bs-toggle="modal" data-bs-target="createSpecies">
                        <i class="fas fa-plus-circle"></i>
                        <span data-text="addButton"></span>
                    </button>
                </div>
            </article> --}}
            <article class="box">
                @include('partials.admin.usersTable', ['users' => $users])
            </article>
        </section>
        {{-- @include('modals.species.create') --}}
        @include('components.message')
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/admin.js') }}" defer></script>
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
    <script type="module" src="{{ asset('js/components/message.js') }}" defer></script>
@endpush
