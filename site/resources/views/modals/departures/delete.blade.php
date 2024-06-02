<section class="modal fade modal-common modal__management danger" id="deleteDepartureModal" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="deleteModalLabel" data-text="confirmDelete"></h2>

            <article class="form">
                <form method="POST"
                    data-action-template="{{ route('departures.destroy', ['language' => app()->getLocale(), 'departure' => ':id']) }}">
                    @csrf
                    @method('DELETE')
                    <div class="form__group">
                        <ul class="form__group">
                            <li class="form__group__content">
                                <label data-text="departureNameModal"></label>
                                <span id="deleteDepartureName" class="form__group__value"></span>
                            </li>
                        </ul>
                        <p class="form__group__content" data-text="messageDelete"></p>
                    </div>
                    <div class="form__group__buttons">
                        <button type="button" class="btn-close form__button__back" data-bs-dismiss="modal"
                            data-text="cancelButton"></button>
                        <button type="submit" class="btn btn-primary form__button__close"
                            data-text="deleteButton"></button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
