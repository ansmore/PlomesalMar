@extends('layouts.main')

@section('title', 'Transects')
@section('content')

    <main class="management" data-view="transects">
        @include('components.asideMenu')
        <section id="head" class="row">
            <article class="box">
                <h1 class="box__title" data-text="transectsList"></h1>
            </article>
            <article class="box__table">
                <div class="box__search">
                    @include('components.search')
                    <button type="button" class="form__button__success" data-bs-toggle="modal"
                        data-bs-target="createTransect">
                        <i class="fas fa-plus-circle"></i>
                        <span data-text="addButton"></span>
                    </button>
                </div>
                @include('partials.transectsTable', ['transects' => $transects])
            </article>
        </section>
        @include('modals.transects.create')
        @include('components.message')
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/management.js') }}" defer></script>
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
    <script type="module" src="{{ asset('js/components/message.js') }}" defer></script>
@endpush
