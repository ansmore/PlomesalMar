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

                        <form class="observation-form" method="post"
                            action="{{ route('observations.observation.update', ['language' => app()->getLocale(), 'observation' => $observation->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Seleccionar Departure -->
                            <div class="table__group">
                                <label for="departure" class="table__group__content">Selecciona Departure</label>
                                <select name="departure_id" id="departure" class="table__group__select" required>
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
                            <!-- Introducir Hora -->
                            <div class="table__group">
                                <label for="time" class="table__group__content">Hora de Observación</label>
                                <input type="time" name="time" id="time" class="table__group__input"
                                    value="{{ $observation->time }}" required>
                            </div>

                            <!-- Introducir Waypoint -->
                            <div class="table__group">
                                <label for="waypoint" class="table__group__content">Waypoint</label>
                                <input type="text" name="waypoint" id="waypoint" class="table__group__input"
                                    value="{{ $observation->waypoint }}" required>
                            </div>

                            <!-- Seleccionar Especie y Opciones -->
                            <div class="table__group">
                                <label for="species_id" class="table__group__content">Selecciona Especie</label>
                                <select name="species_id" id="species_id" class="table__group__select" required>
                                    @foreach ($species as $specie)
                                        <option value="{{ $specie->id }}"
                                            {{ $specie->id == $observation->species_id ? 'selected' : '' }}>
                                            {{ $specie->common_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="table__group">
                                <label for="in_flight" class="table__group__content">En Vuelo</label>
                                <input class="table__group__check" type="checkbox" name="in_flight" id="in_flight"
                                    value="1" {{ $observation->in_flight ? 'checked' : '' }}>
                            </div>
                            <div class="table__group">
                                <label for="distance_under_300m" class="table__group__content">Distancia Menor a
                                    300m</label>
                                <input class="table__group__check" type="checkbox" name="distance_under_300m"
                                    id="distance_under_300m" value="1"
                                    {{ $observation->distance_under_300m ? 'checked' : '' }}>
                            </div>

                            <!-- Introducir Número de Individuos -->
                            <div class="table__group">
                                <label for="number_of_individuals" class="table__group__content">Número de
                                    Individuos</label>
                                <input type="number" name="number_of_individuals" id="number_of_individuals"
                                    class="table__group__input" value="{{ $observation->number_of_individuals }}" required>
                            </div>
                            <h3 class="table__group__title">Imatges actuals</h3>
                            <input type="hidden" name="existing_images" id="existing-images"
                                value="{{ json_encode($imageUrls) }}">
                            @foreach ($imageUrls as $image)
                                <div class="image-container">
                                    <p>{{ $image['user'] }}</p>
                                    <picture>
                                        <source srcset="{{ $image['images']['large'] }}" media="(min-width: 1200px)">
                                        <source srcset="{{ $image['images']['medium'] }}" media="(min-width: 600px)">
                                        <img src="{{ $image['images']['small'] }}" style="width:10%" alt="Image"
                                            class="editable-image" data-image-id="{{ $image['image_id'] }}">
                                    </picture>
                                    <button type="button" class="btn btn-danger delete-image form__button__close"
                                        data-image-id="{{ $image['image_id'] }}">Eliminar</button>
                                    <input type="file" name="image_file[{{ $image['image_id'] }}]" accept="image/*"
                                        class="edit-image-file table__group__input"
                                        data-image-id="{{ $image['image_id'] }}" style="display: none;">
                                    <div class="image-preview-container" style="display: none;">
                                        <img src="" class="new-image-preview" style="width:10%;">
                                    </div>
                                </div>
                            @endforeach
                            <h3 class="table__group__title">Afegir noves imatges</h3>
                            <div id="new-images-container">
                                <div class="new-image">
                                    <div class="table__group">
                                        <label class="table__group__content">Afegir nova imatge</label>
                                        <input type="file" name="image_file_new[]" accept="image/*"
                                            class="new-image-input table__group__input">
                                    </div>
                                    <div class="table__group">
                                        <img src="" class="new-image-preview table__group__input"
                                            style="display:none; width:10%;">
                                    </div>
                                    <div class="table__group">
                                        <label class="table__group__content">Tria usuari</label>
                                        <select class="table__group__select name="image_user_new[]">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="table__group">
                                        <label class="table__group__content">
                                            Numero de fotografia</label>
                                        <input type="number" class="table__group__input" name="image_number_new[]"
                                            placeholder="Photography Number">
                                    </div>
                                </div>
                            </div>
                            <div class="table__group__buttons">
                                <button type="button" id="add-new-image"
                                    class="btn btn-primary form__button__success">Afegir imatge</button>
                            </div>
                            <!-- Notas -->
                            <div class="table__group">
                                <label for="notes" class="table__group__content">Notes</label>
                                <textarea name="notes" id="notes" class="textarea-form table__group__textarea" rows="4">{{ $observation->notes }}</textarea>
                            </div>
                            <div class="table__group">
                                <label for="is_validated" class="table__group__content">Validado</label>
                                <input type="checkbox" class="table__group__check" name="is_validated" id="is_validated"
                                    value="1" {{ $observation->is_validated ? 'checked' : '' }}>
                            </div>
                            <div class="table__group__buttons">
                                <button type="submit" class="btn btn-success form__button__success">Guardar
                                    Cambios</button>
                            </div>
                        </form>

                        <form id="delete-image-form"
                            action="{{ route('observations.deleteImage', ['language' => app()->getLocale(), 'observation' => $observation->id]) }}"
                            method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="image_id" id="delete-image-id">
                        </form>
                    </div>
                </div>
            </article>
        </section>
    </main>

    @push('scripts')
        <script>
            const users = @json($users);
        </script>
        <script type="module" src="{{ asset('js/pages/observationsPage/edit.js') }}" defer></script>
        <script type="module" src="{{ asset('js/pages/management.js') }}" defer></script>
        <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
        <script type="module" src="{{ asset('js/components/message.js') }}" defer></script>
    @endpush

@endsection
