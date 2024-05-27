<section class="modal fade modal-common modal__management__big" id="deleteObservationModal" tabindex="-1"
    aria-labelledby="deleteObservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal__management__big__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="deleteObservationModalLabel">Confirmación de Eliminación</h2>
            <article class="form">
                <form method="POST" id="deleteObservationForm"
                    data-action-template="{{ route('observations.destroy', ['language' => app()->getLocale(), 'observation' => ':id']) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="deleteObservationId">
                    <div class="form__group">
                        <p>Estás a punto de eliminar permanentemente la observación:</p>
                        <ul>
                            <li>Nombre: <strong id="deleteObservationName"></strong></li>
                        </ul>
                        <p>Esta acción eliminará todas las imágenes relacionadas. ¿Deseas proceder?</p>
                    </div>
                    <div class="form__group__buttons">
                        <button type="button" class="btn-close form__button__back" data-bs-dismiss="modal"
                            data-text="cancelButton">Cancelar</button>
                        <button type="submit" class="btn btn-primary form__button__success"
                            data-text="deleteButton">Eliminar</button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
