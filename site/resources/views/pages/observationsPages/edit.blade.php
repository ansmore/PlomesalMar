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
                    action="{{ route('observations.observation.update', ['language' => app()->getLocale(), 'observation' => $observation->id]) }}"
                    enctype="multipart/form-data">
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

                    <h3>Imágenes actuales</h3>
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
                            <button type="button" class="btn btn-danger delete-image"
                                data-image-id="{{ $image['image_id'] }}">Eliminar</button>
                            <input type="file" name="image_file[{{ $image['image_id'] }}]" accept="image/*"
                                class="edit-image-file" data-image-id="{{ $image['image_id'] }}" style="display: none;">
                        </div>
                    @endforeach

                    <h3>Añadir nuevas imágenes</h3>
                    <div id="new-images-container">
                        <div class="new-image">
                            <input type="file" name="image_file_new[]" accept="image/*">
                            <select name="image_user_new[]">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="image_number_new[]" placeholder="Photography Number">
                        </div>
                    </div>
                    <button type="button" id="add-new-image" class="btn btn-primary">Añadir Imagen</button>

                    <!-- Notas -->
                    <div class="form-section">
                        <label for="notes" class="label-form">Notas</label>
                        <textarea name="notes" id="notes" class="textarea-form" rows="4">{{ $observation->notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                </form>

                <form id="delete-image-form"
                    action="{{ route('observations.deleteImage', ['language' => app()->getLocale(), 'observation' => $observation->id]) }}"
                    method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="image_id" id="delete-image-id">
                </form>
            </article>
        </section>
    </main>

    <script>
        document.getElementById('add-new-image').addEventListener('click', function() {
            var container = document.getElementById('new-images-container');
            var newImageDiv = document.createElement('div');
            newImageDiv.classList.add('new-image');
            newImageDiv.innerHTML = `
        <input type="file" name="image_file_new[]" accept="image/*">
        <select name="image_user_new[]">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <input type="number" name="image_number_new[]" placeholder="Photography Number">
    `;
            container.appendChild(newImageDiv);
        });

        document.querySelectorAll('.editable-image').forEach(image => {
            image.addEventListener('click', function() {
                var imageId = this.dataset.imageId;
                var editInput = document.querySelector(`.edit-image-file[data-image-id='${imageId}']`);
                editInput.click();
            });
        });

        document.querySelectorAll('.delete-image').forEach(button => {
            button.addEventListener('click', function() {
                var imageId = this.dataset.imageId;
                if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
                    document.getElementById('delete-image-id').value = imageId;
                    document.getElementById('delete-image-form').submit();
                }
            });
        });
    </script>
@endsection
