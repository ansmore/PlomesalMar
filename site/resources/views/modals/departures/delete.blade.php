<section class="modal fade modal-common modal__management danger" id="deleteDepartureModal" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__box">
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
                        <ul class="form__group">
                            <li class="form__group__content">
                                <span>Nombre: </span>
                                <span id="deleteDepartureName"></span>
                            </li>
                        </ul>
                        <p class="form__group__content">Esta acción también eliminará todas las observaciones
                            relacionadas. ¿Deseas proceder?</p>
                        <p data-text="messageDelete" class="form__group__content">Estás a punto de eliminar
                            permanentemente la salida:</p>
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
