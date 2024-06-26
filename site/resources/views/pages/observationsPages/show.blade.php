@extends('layouts.main')

@section('title', 'Detalles de la Observación')
@section('content')

    <main class="management" data-view="showObservation">
        @include('components.asideMenu')
        <section id="details" class="row">
            <article class="box">
                <h1 class="box__title" data-text="observationDetails">Detalls observació</h1>
            </article>
            <article class="box__form">
                <div class="box__back">
                    <a href="{{ route('observations.index', [
                        'language' => $language,
                    ]) }}"
                        class="form__button__back">
                        <i class="fas fa-arrow-left"></i>
                        <span data-text="back"></span>
                    </a>
                </div>
                <div class="card">
                    <div class="tableObservation">

                        <div class="table__group">
                            <label class="table__group__content" data-text="selectDeperture"></label>
                            <p class="table__group__value">{{ $departures->firstWhere('id', $departureId)->date }}</p>
                        </div>
                        <div class="table__group">
                            <label class="table__group__content">Hora de Observación</label>
                            <p class="table__group__value">{{ $observation->time }}</p>
                        </div>
                        <div class="table__group">
                            <label class="table__group__content">Waypoint</label>
                            <p class="table__group__value">{{ $observation->waypoint }}</p>
                        </div>
                        <div class="table__group">
                            <label class="table__group__content">Especie</label>
                            <p class="table__group__value">{{ $observation->species->common_name }}</p>
                        </div>
                        <div class="table__group">
                            <label class="table__group__content">En Vuelo</label>
                            <p class="table__group__value">{{ $observation->in_flight ? 'Sí' : 'No' }}</p>
                        </div>
                        <div class="table__group">
                            <label class="table__group__content">Distancia Menor a 300m</label>
                            <p class="table__group__value">{{ $observation->distance_under_300m ? 'Sí' : 'No' }}</p>
                        </div>
                        <div class="table__group">
                            <label class="table__group__content">Número de Individuos</label>
                            <p class="table__group__value">{{ $observation->number_of_individuals }}</p>
                        </div>
                        <div class="table__group">
                            <label class="table__group__content">Notas</label>
                            <p class="table__group__value">{{ $observation->notes }}</p>
                        </div>
                        <div class="table__group">
                            <label class="table__group__content">Observadores</label>
                            <ul id="details_observers" class="table__group__box">
                                @foreach ($departures->firstWhere('id', $departureId)->observer_users as $user)
                                    <li>{{ $user->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="form-section">
                            @foreach ($imageUrls as $index => $imageData)
                                <div class="form-group">
                                    <label>Usuario: {{ $imageData['user'] }}</label>
                                    <picture>
                                        <source media="(max-width: 600px)" srcset="{{ $imageData['images']['small'] }}">
                                        <source media="(min-width: 601px) and (max-width: 1200px)"
                                            srcset="{{ $imageData['images']['medium'] }}">
                                        <source media="(min-width: 1201px)" srcset="{{ $imageData['images']['large'] }}">
                                        <img src="{{ $imageData['images']['large'] }}" alt="Imagen"
                                            style="max-width: 10%;">
                                    </picture>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </main>

    @push('scripts')
        <script type="module" src="{{ asset('js/pages/management.js') }}" defer></script>
        <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
        <script type="module" src="{{ asset('js/components/message.js') }}" defer></script>
    @endpush

@endsection
