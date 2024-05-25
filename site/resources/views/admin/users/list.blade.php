@extends('layouts.main')

@section('title', 'Users')
@section('content')

    <main class="management" data-view="users">
        @include('components.asideMenu')
        <section id="head" class="row">
            <article class="box">
                <h1 class="box__title" data-text="usersList"></h1>
            </article>
            <article class="box">
                <div class="box__next">
                    <button type="button" class="form__button__success" data-bs-toggle="modal" data-bs-target="createUser">
                        <i class="fas fa-plus-circle"></i>
                        <span data-text="addButton"></span>
                    </button>
                </div>
            </article>
            <article class="box">
                @include('partials.admin.usersTable', ['users' => $users])
            </article>
        </section>
        @include('modals.users.create')
        @include('components.message')
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/admin.js') }}" defer></script>
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
    <script type="module" src="{{ asset('js/components/message.js') }}" defer></script>
@endpush
