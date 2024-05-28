@extends('layouts.main')

@section('title', 'Edit Observation')
@section('content')

    <main class="management" data-view="editObservation">
        @include('components.asideMenu')
        <section id="form" class="row">
            <article class="box">
                <h1 class="box__title">Edit Observation</h1>
            </article>
            <article class="box__form">
                <form class="observation-form" method="post"
                    action="{{ route('observations.observation.update', ['language' => app()->getLocale(), 'observation' => $observation->id]) }}">
                    @csrf
                    @method('PUT')

                    <!-- Seleccionar Departure -->
                    <div class="form-section">
                        <div class="form-group">
                            <label for="departure" class="label-form">Selecciona Departure</label>
                            <select name="departure_id" id="departure" class="select-desktop" required>
                                <option value="">Selecciona una Departure</option>
                                @foreach ($departures as $departure)
                                    <option value="{{ $departure->id }}"
                                        data-observers="{{ $departure->observer_users->toJson() }}"
                                        {{ $departure->id == $departureId ? 'selected' : '' }}>
                                        {{ $departure->date }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Introducir Hora -->
                    <div class="form-section">
                        <label for="time" class="label-form">Hora de Observación</label>
                        <input type="time" name="time" id="time" class="input-form"
                            value="{{ $observation->time }}" required>
                    </div>

                    <!-- Introducir Waypoint -->
                    <div class="form-section">
                        <label for="waypoint" class="label-form">Waypoint</label>
                        <input type="text" name="waypoint" id="waypoint" class="input-form"
                            value="{{ $observation->waypoint }}" required>
                    </div>

                    <!-- Seleccionar Especie y Opciones -->
                    <div class="form-section">
                        <div class="form-group">
                            <label for="species_id" class="label-form">Selecciona Especie</label>
                            <select name="species_id" id="species_id" class="select-desktop" required>
                                @foreach ($species as $specie)
                                    <option value="{{ $specie->id }}"
                                        {{ $specie->id == $observation->species_id ? 'selected' : '' }}>
                                        {{ $specie->common_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="in_flight" class="label-form">En Vuelo</label>
                            <input type="checkbox" name="in_flight" id="in_flight" value="1"
                                {{ $observation->in_flight ? 'checked' : '' }}>
                        </div>
                        <div class="form-group">
                            <label for="distance_under_300m" class="label-form">Distancia Menor a 300m</label>
                            <input type="checkbox" name="distance_under_300m" id="distance_under_300m" value="1"
                                {{ $observation->distance_under_300m ? 'checked' : '' }}>
                        </div>
                    </div>

                    <!-- Introducir Número de Individuos -->
                    <div class="form-section">
                        <label for="number_of_individuals" class="label-form">Número de Individuos</label>
                        <input type="number" name="number_of_individuals" id="number_of_individuals" class="input-form"
                            value="{{ $observation->number_of_individuals }}" required>
                    </div>

                    <!-- Mostrar Imágenes -->
                    <div class="form-section">
                        <label for="images" class="label-form">Imágenes</label>
                        <div id="image-container">
                            @foreach ($imageUrls as $index => $imageData)
                                <div class="form-group">
                                    <label>Usuario: {{ $imageData['user'] }}</label>
                                    <picture>
                                        <source media="(max-width: 600px)" srcset="{{ $imageData['images']['small'] }}">
                                        <source media="(min-width: 601px) and (max-width: 1200px)"
                                            srcset="{{ $imageData['images']['medium'] }}">
                                        <source media="(min-width: 1201px)" srcset="{{ $imageData['images']['large'] }}">
                                        <img src="{{ $imageData['images']['large'] }}" alt="Imagen existente"
                                            style="max-width: 10%;">
                                    </picture>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Notas -->
                    <div class="form-section">
                        <label for="notes" class="label-form">Notas</label>
                        <textarea name="notes" id="notes" class="textarea-form" rows="4">{{ $observation->notes }}</textarea>
                    </div>

                    <button type="submit" class="btn-form btn-save">Actualizar Observación</button>
                </form>
            </article>
        </section>
    </main>
@endsection
