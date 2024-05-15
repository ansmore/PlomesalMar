<section class="modal fade modal-common modal__management danger" id="deleteBoatModal" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar"><i
                class="fa-solid fa-xmark"></i></button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="deleteModalLabel" data-text="confirmDelete"></h2>
            <article class="form">
                <form id="deleteBoatForm" action="" method="POST"
                    data-delete-url-template="{{ route('boats.destroy', [':id', 'language' => app()->getLocale()]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="form__group">
                        <ul class="form__group">
                            <li class="form__group__content">
                                <span data-text="boatsNameModal"></span>
                                <span id="deleteBoatName"></span>
                            </li>
                            <li class="form__group__content">
                                <span data-text="boatsRegistrationPlateModal"></span>
                                <span id="deleteRegistrationNumber"></span>
                            </li>
                        </ul>
                        <p class="form__group__content" data-text="messageDelete"></p>
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
