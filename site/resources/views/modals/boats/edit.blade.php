<div class="modal fade modal-common" id="editBoatModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editModalLabel">Editar Barco</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <form id="editBoatForm" action="" method="POST"
                data-edit-url-template="{{ route('boats.update', [':id', 'language' => app()->getLocale()]) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="boatName" class="form-label">Nombre del Barco</label>
                        <input type="text" class="form-control" id="boatName" name="name" value="" />
                    </div>
                    <div class="mb-3">
                        <label for="registrationNumber" class="form-label">Número de Registro</label>
                        <input type="text" class="form-control" id="registrationNumber" name="registration_number"
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
