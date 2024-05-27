@extends('layouts.main')

@section('title', 'Detalles de la Observación')
@section('content')

    <main class="management" data-view="showObservation">
        @include('components.asideMenu')
        <section id="details" class="row">
            <article class="box">
                <h1 class="box__title">Detalles de la Observación</h1>
            </article>
            <article class="box__details">
                <div class="form-section">
                    <label class="label-form">Departure</label>
                    <p>{{ $departures->firstWhere('id', $departureId)->date }}</p>
                </div>
                <div class="form-section">
                    <label class="label-form">Hora de Observación</label>
                    <p>{{ $observation->time }}</p>
                </div>
                <div class="form-section">
                    <label class="label-form">Waypoint</label>
                    <p>{{ $observation->waypoint }}</p>
                </div>
                <div class="form-section">
                    <label class="label-form">Especie</label>
                    <p>{{ $observation->species->common_name }}</p>
                </div>
                <div class="form-section">
                    <label class="label-form">En Vuelo</label>
                    <p>{{ $observation->in_flight ? 'Sí' : 'No' }}</p>
                </div>
                <div class="form-section">
                    <label class="label-form">Distancia Menor a 300m</label>
                    <p>{{ $observation->distance_under_300m ? 'Sí' : 'No' }}</p>
                </div>
                <div class="form-section">
                    <label class="label-form">Número de Individuos</label>
                    <p>{{ $observation->number_of_individuals }}</p>
                </div>
                <div class="form-section">
                    <label class="label-form">Notas</label>
                    <p>{{ $observation->notes }}</p>
                </div>
                <div class="form-section">
                    <label class="label-form">Observadores</label>
                    @foreach ($departures->firstWhere('id', $departureId)->observer_users as $user)
                        <p>{{ $user->name }}</p>
                    @endforeach
                </div>
                <div class="form-section">
                    <label class="label-form">Imágenes</label>
                    @foreach ($imageUrls as $index => $imageData)
                        <div class="form-group">
                            <label>Usuario: {{ $imageData['user'] }}</label>
                            <picture>
                                <source media="(max-width: 600px)" srcset="{{ $imageData['images']['small'] }}">
                                <source media="(min-width: 601px) and (max-width: 1200px)"
                                    srcset="{{ $imageData['images']['medium'] }}">
                                <source media="(min-width: 1201px)" srcset="{{ $imageData['images']['large'] }}">
                                <img src="{{ $imageData['images']['large'] }}" alt="Imagen" style="max-width: 100%;">
                            </picture>
                        </div>
                    @endforeach
                </div>
            </article>
        </section>
    </main>
@endsection
