<div class="modal fade" id="editSpeciesModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editModalLabel">Editar Especie</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <form id="editSpeciesForm" action="" method="POST"
                data-edit-url-template="{{ route('species.update', [':id', 'language' => app()->getLocale()]) }}">>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombreComun" class="form-label">Nombre Común</label>
                        <input type="text" class="form-control" id="nombreComun" name="nombre_comun"
                            value="" />
                    </div>
                    <div class="mb-3">
                        <label for="nombreCientifico" class="form-label">Nombre Científico</label>
                        <input type="text" class="form-control" id="nombreCientifico" name="nombre_cientifico"
                            value="" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
