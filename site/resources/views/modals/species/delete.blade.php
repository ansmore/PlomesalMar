<section class="modal fade modal-common modal__management danger" id="deleteSpeciesModal" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar"><i
                class="fa-solid fa-xmark"></i></button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="deleteModalLabel">Confirmación de Eliminación</h2>
            <article class="form">
                <form id="deleteSpeciesForm" action="" method="POST"
                    data-delete-url-template="{{ route('species.destroy', [':id', 'language' => app()->getLocale()]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="form__group">
                        <p class="form__group__content">Estás a punto de eliminar permanentemente la especie:</p>
                        <ul class="form__group">
                            <li class="form__group__content">
                                <span>Nombre Común: </span>
                                <span id="deleteCommonName"></span>
                            </li>
                            <li class="form__group__content">
                                <span>Nombre Científico: </span>
                                <span id="deleteScientificName"></span>
                            </li>
                        </ul>
                        <p class="form__group__content">Esta acción también eliminará todas las observaciones
                            relacionadas. ¿Deseas proceder?</p>
                    </div>
                    <div class="form__group__buttons">
                        <button type="button" class="btn btn-secondary form__button__back"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger form__button__close">Eliminar</button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
