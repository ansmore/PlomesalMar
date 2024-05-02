<section id="infoModal_2" class="modal" data-type="2">
    <div id="modalBox_2" class="modal__box">
        <span class="close" id="closeModalButton_2">
            <i class="fa-solid fa-xmark"></i>
        </span>
        <article class="body" id="modalBodyContent_2">
            {{-- <div class="modalcreate" id="createSpecies" tabindex="-1" aria-labelledby="modalLabelNuevo"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content"> --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalLabelNuevo">Agregar Nueva Especie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form method="POST" action="{{ route('species.store', ['language' => app()->getLocale()]) }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombreComun" class="form-label">Nombre Común</label>
                        <input type="text" class="form-control" id="nombreComun" name="nombre_comun"
                            placeholder="Ejemplo: Colibrí Esmeralda">
                    </div>
                    <div class="mb-3">
                        <label for="nombreCientifico" class="form-label">Nombre Científico</label>
                        <input type="text" class="form-control" id="nombreCientifico" name="nombre_cientifico"
                            placeholder="Ejemplo: Chlorostilbon maugaeus">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Especie</button>
                </div>
            </form>
            {{-- </div>
    </div>
    </div> --}}

        </article>
    </div>
</section>
