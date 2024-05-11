@extends('layouts.main')

@section('title', "Detalls user $user->name")
@section('content')

    <main class="management">
        @include('components.asideManagement')
        <section id="head" class="row">
            <article class="box">
                <h1 class="box__title" data-text="userDetails"></h1>
            </article>
            <article class="box">
                <div class="box__back">
                    <a href="{{ route('admin.users', [
                        'language' => $language,
                    ]) }}"
                        class="form__button__back">
                        <i class="fas fa-arrow-left"></i>
                        <span data-text="back"></span>
                    </a>
                </div>
                @include('partials.admin.userDetailsTable', ['user' => $user])
            </article>
        </section>
        {{-- @include('modals.species.create') --}}
        {{-- @include('components.mesage') --}}
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/admin.js') }}" defer></script>
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
    <script type="module" src="{{ asset('js/components/mesage.js') }}" defer></script>
@endpush
