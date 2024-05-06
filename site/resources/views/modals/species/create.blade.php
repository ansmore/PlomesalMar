<section class="modal fade modal-common modal__management" id="createSpecies" tabindex="-1"
    aria-labelledby="modalLabelNuevo" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="modalLabelNuevo">Agregar Nueva Especie</h2>
            <article class="form">
                <form method="POST" action="{{ route('species.store', ['language' => app()->getLocale()]) }}">
                    @csrf
                    <div class="form__group">
                        <label for="nombreComun" class="form__group__content">Nombre Común</label>
                        <input type="text" class="form__group__input" id="nombreComun" name="nombre_comun"
                            placeholder="Ejemplo: Colibrí Esmeralda">
                    </div>
                    <div class="form__group">
                        <label for="nombreCientifico" class="form__group__content">Nombre Científico</label>
                        <input type="text" class="form__group__input" id="nombreCientifico" name="nombre_cientifico"
                            placeholder="Ejemplo: Chlorostilbon maugaeus">
                    </div>
                    <div class="form__group__buttons">
                        <button type="button" class="btn-close form__button__back"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary form__button">Guardar Especie</button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
