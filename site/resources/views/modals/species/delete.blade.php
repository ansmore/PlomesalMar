<div class="modal-wrapper fade" id="deleteSpecies{{ $specie->id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel{{ $specie->id }}" aria-hidden="true">
    <div class="modal-center">
        <div class="modal-box">
            <div class="modal-top bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel{{ $specie->id }}">Confirmación de Eliminación</h5>
                <button type="button" class="button-close button-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('species.destroy', ['language' => app()->getLocale(), 'species' => $specie->id]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Estás a punto de eliminar permanentemente la especie:</p>
                    <ul>
                        <li>Nombre Común: <strong>{{ $specie->common_name }}</strong></li>
                        <li>Nombre Científico: <strong>{{ $specie->scientific_name }}</strong></li>
                    </ul>
                    <p>Esta acción también eliminará todas las observaciones relacionadas. ¿Deseas proceder?</p>
                </div>
                <div class="modal-bottom">
                    <button type="button" class="button-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="button-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
