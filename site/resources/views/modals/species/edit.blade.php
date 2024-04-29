<div class="modal fade" id="editSpecies{{ $specie->id }}" tabindex="-1"
    aria-labelledby="editModalLabel{{ $specie->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editModalLabel{{ $specie->id }}">Editar Especie</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Cerrar"></button>
            </div>
            <form action="{{ route('species.update', ['language' => app()->getLocale(), 'species' => $specie->id]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombreComun{{ $specie->id }}" class="form-label">Nombre Común</label>
                        <input type="text" class="form-control" id="nombreComun{{ $specie->id }}"
                            name="nombre_comun" value="{{ $specie->common_name }}" />
                    </div>
                    <div class="mb-3">
                        <label for="nombreCientifico{{ $specie->id }}" class="form-label">Nombre Científico</label>
                        <input type="text" class="form-control" id="nombreCientifico{{ $specie->id }}"
                            name="nombre_cientifico" value="{{ $specie->scientific_name }}" />
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
