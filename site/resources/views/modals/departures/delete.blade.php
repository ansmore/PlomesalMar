<section class="modal fade modal-common modal__management__big" id="deleteDepartureModal" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal__management__big__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="deleteModalLabel">Confirmación de Eliminación</h2>
            <article class="form">
                <form method="POST"
                    data-action-template="{{ route('departures.destroy', ['language' => app()->getLocale(), 'departure' => ':id']) }}">
                    @csrf
                    @method('DELETE')
                    <div class="form__group">
                        <p>Estás a punto de eliminar permanentemente la salida:</p>
                        <ul>
                            <li>Nombre: <strong id="deleteDepartureName"></strong></li>
                        </ul>
                        <p>Esta acción también eliminará todas las observaciones relacionadas. ¿Deseas proceder?</p>
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
