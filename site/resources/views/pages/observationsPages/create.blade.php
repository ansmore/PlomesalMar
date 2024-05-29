@extends('layouts.main')

@section('title', 'Create Observation')
@section('content')

    <main class="management" data-view="createObservation">
        @include('components.asideMenu')
        <section id="form" class="row">
            <article class="box">
                <h1 class="box__title" data-text="observationNew"></h1>
            </article>
            <article class="box__form">
                <div class="card">
                    <div class="tableObservation">

                        <form class="observation-form" method="post"
                            action="{{ route('observations.observation.store', ['language' => app()->getLocale()]) }}"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Seleccionar Departure -->
                            <div class="form-section">
                                <div class="table__group">
                                    <label for="departure" class="table__group__content"
                                        data-text="selectDeperture"></label>
                                    <select name="departure_id" id="departure" class="table__group__select" required>
                                        <option value="" data-text="selectDepertureOption"></option>
                                        @foreach ($departures as $departure)
                                            <option value="{{ $departure->id }}"
                                                data-observers="{{ $departure->observer_users }}">
                                                {{ $departure->date }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Introducir Hora -->
                            <div class="table__group">
                                <label for="time" class="table__group__content"
                                    data-text="timeObservationCreate"></label>
                                <input type="time" name="time" id="time" class="table__group__input" required>
                            </div>

                            <!-- Introducir Waypoint -->
                            <div class="table__group">
                                <label for="waypoint" class="table__group__content" data-text="waypoint"></label>
                                <input type="text" name="waypoint" id="waypoint" class="table__group__input" required>
                            </div>

                            <!-- Seleccionar Especie y Opciones -->
                            <div class="form-section">
                                <div class="table__group">
                                    <label for="species_id" class="table__group__content" data-text="selectSpecie"></label>
                                    <select name="species_id" id="species_id" class="table__group__select" required>
                                        @foreach ($species as $specie)
                                            <option value="{{ $specie->id }}">{{ $specie->common_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="table__group">
                                    <label for="in_flight" class="table__group__content" data-text="flight"></label>
                                    <input class="table__group__check" type="checkbox" name="in_flight" id="in_flight"
                                        value="1">
                                </div>
                                <div class="table__group">
                                    <label for="distance_under_300m" class="table__group__content"
                                        data-text="distance"></label>
                                    <input class="table__group__check" type="checkbox" name="distance_under_300m"
                                        id="distance_under_300m" value="1">
                                </div>
                            </div>

                            <!-- Introducir Número de Individuos -->
                            <div class="table__group">
                                <label for="number_of_individuals" class="table__group__content"
                                    data-text="numberElements"></label>
                                <input type="number" name="number_of_individuals" id="number_of_individuals"
                                    class="table__group__input" required>
                            </div>

                            <!-- Añadir Imágenes -->
                            <div class="form-section">
                                <div id="image-container">
                                    <!-- Contenedor para añadir múltiples imágenes -->
                                </div>
                                <div class="table__group__buttons">
                                    <button type="button" onclick="addImageField()" class="form__button__success"
                                        data-text="addImage"></button>
                                </div>
                            </div>

                            <!-- Notas -->
                            <div class="table__group">
                                <label for="notes" class="table__group__content" data-text="notes"></label>
                                <textarea name="notes" id="notes" class="table__group__textarea" rows="4"></textarea>
                            </div>

                            <div class="table__group__buttons">
                                <button type="submit" class="btn-form btn-save form__button__success"
                                    data-text="createObservation"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </article>
        </section>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/pages/management.js') }}" defer></script>
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
    <script type="module" src="{{ asset('js/components/message.js') }}" defer></script>
    <script>
        document.getElementById('departure').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const observers = JSON.parse(selectedOption.getAttribute('data-observers'));

            document.querySelectorAll('.image-user-select').forEach(select => {
                select.innerHTML = observers.map(observer =>
                    `<option value="${observer.id}">${observer.name}</option>`).join('');
            });
        });

        function addImageField() {
            const container = document.getElementById('image-container');
            const div = document.createElement('div');
            div.classList.add('table__group');

            const index = container.children.length;

            div.innerHTML = `
        <label for="image_user_${index}" class="table__group__content" data-text="user">Usuari</label>
        <select name="image_user[]" id="image_user_${index}" class="table__group__select image-user-select" required></select>
        <label for="image_number_${index}" class="table__group__content" data-text="imageNumber">Numero de la imatge</label>
        <input type="number" name="image_number[]" id="image_number_${index}" class="table__group__input" required>
        <label for="image_file_${index}" class="table__group__content" data-text="image">Imatge</label>
        <input type="file" name="image_file[]" id="image_file_${index}" class="table__group__input" accept="image/*" required onchange="previewImage(event, ${index})">
        <img id="image_preview_${index}" src="" alt="Vista previa de la imagen" style="display:none; max-width: 200px; margin-top: 10px;">
    `;
            container.appendChild(div);

            const departureSelect = document.getElementById('departure');
            const selectedOption = departureSelect.options[departureSelect.selectedIndex];
            const observers = JSON.parse(selectedOption.getAttribute('data-observers'));

            const newSelect = div.querySelector('.image-user-select');
            newSelect.innerHTML = observers.map(observer => `<option value="${observer.id}">${observer.name}</option>`)
                .join('');
        }

        function previewImage(event, index) {
            const input = event.target;
            const preview = document.getElementById(`image_preview_${index}`);

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
@endpush
