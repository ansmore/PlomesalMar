@extends('layouts.main')

@section('title', 'Create Observation')
@section('content')

    <main class="management" data-view="createObservation">
        @include('components.asideMenu')
        <section id="form" class="row">
            <article class="box">
                <h1 class="box__title">Create Observation</h1>
            </article>
            <article class="box__form">
                <form class="observation-form" method="post"
                    action="{{ route('observations.store', ['language' => app()->getLocale()]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Seleccionar Departure -->
                    <div class="form-section">
                        <div class="form-group">
                            <label for="departure" class="label-form">Selecciona Departure</label>
                            <select name="departure_id" id="departure" class="select-desktop" required>
                                <option value="">Selecciona una Departure</option>
                                @foreach ($departures as $departure)
                                    <option value="{{ $departure->id }}">{{ $departure->date }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Lista de Usuarios -->
                    <div class="form-section">
                        <div class="form-group">
                            <label for="users" class="label-form">Selecciona Usuarios</label>
                            <select name="user_ids[]" id="users" class="select-desktop" multiple required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Introducir Hora -->
                    <div class="form-section">
                        <label for="time" class="label-form">Hora de Observación</label>
                        <input type="time" name="time" id="time" class="input-form" required>
                    </div>

                    <!-- Introducir Waypoint -->
                    <div class="form-section">
                        <label for="waypoint" class="label-form">Waypoint</label>
                        <input type="text" name="waypoint" id="waypoint" class="input-form" required>
                    </div>

                    <!-- Seleccionar Especie y Opciones -->
                    <div class="form-section">
                        <div class="form-group">
                            <label for="species_id" class="label-form">Selecciona Especie</label>
                            <select name="species_id" id="species_id" class="select-desktop" required>
                                @foreach ($species as $specie)
                                    <option value="{{ $specie->id }}">{{ $specie->common_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="in_flight" class="label-form">En Vuelo</label>
                            <input type="checkbox" name="in_flight" id="in_flight" value="1">
                        </div>
                        <div class="form-group">
                            <label for="distance_under_300m" class="label-form">Distancia Menor a 300m</label>
                            <input type="checkbox" name="distance_under_300m" id="distance_under_300m" value="1">
                        </div>
                    </div>

                    <!-- Introducir Número de Individuos -->
                    <div class="form-section">
                        <label for="number_of_individuals" class="label-form">Número de Individuos</label>
                        <input type="number" name="number_of_individuals" id="number_of_individuals" class="input-form"
                            required>
                    </div>

                    <!-- Añadir Imágenes -->
                    <div class="form-section">
                        <label for="images" class="label-form">Añadir Imágenes</label>
                        <div id="image-container">
                            <!-- Contenedor para añadir múltiples imágenes -->
                        </div>
                        <button type="button" onclick="addImageField()">Agregar Imagen</button>
                    </div>

                    <!-- Notas -->
                    <div class="form-section">
                        <label for="notes" class="label-form">Notas</label>
                        <textarea name="notes" id="notes" class="textarea-form" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn-form btn-save">Crear Observación</button>
                </form>
            </article>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        const departures = @json($departures);

        document.getElementById('departure').addEventListener('change', function() {
            const departureId = this.value;
            const usersSelect = document.getElementById('users');
            usersSelect.innerHTML = ''; // Limpiar opciones actuales

            if (departureId) {
                const selectedDeparture = departures.find(departure => departure.id == departureId);
                selectedDeparture.users.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.name;
                    usersSelect.appendChild(option);
                });
            }
        });

        function addImageField() {
            const container = document.getElementById('image-container');
            const div = document.createElement('div');
            div.classList.add('form-group');

            div.innerHTML = `
            <label for="image_user">Usuario</label>
            <select name="image_user_id[]" class="select-desktop" required>
                ${document.getElementById('users').innerHTML}
            </select>
            <label for="image_number">Número de Imagen</label>
            <input type="number" name="image_number[]" class="input-form" required>
            <label for="image_file">Imagen</label>
            <input type="file" name="image_file[]" class="input-form" accept="image/*" required>
        `;
            container.appendChild(div);
        }
    </script>
@endpush
