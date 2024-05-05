<section class="modal fade modal-common modal__delete" id="deleteSpeciesModal" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__delete__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar"><i
                class="fa-solid fa-xmark"></i></button>
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirmación de Eliminación</h5>
            </div>
            <form id="deleteSpeciesForm" action="" method="POST"
                data-delete-url-template="{{ route('species.destroy', [':id', 'language' => app()->getLocale()]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Estás a punto de eliminar permanentemente la especie:</p>
                    <ul>
                        <li>Nombre Común: <strong id="deleteCommonName"></strong></li>
                        <li>Nombre Científico: <strong id="deleteScientificName"></strong></li>
                    </ul>
                    <p>Esta acción también eliminará todas las observaciones relacionadas. ¿Deseas proceder?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</section>
