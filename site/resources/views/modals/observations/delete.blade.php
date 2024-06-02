<section class="modal fade modal-common modal__management__big danger" id="deleteObservationModal" tabindex="-1"
    aria-labelledby="deleteObservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal__management__big__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="deleteObservationModalLabel" data-text="confirmDelete"></h2>
            <article class="form">
                <form method="POST" id="deleteObservationForm"
                    data-action-template="{{ route('observations.observation.destroy', ['language' => app()->getLocale(), 'observation' => ':id']) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="deleteObservationId">
                    <div class="form__group">
                        <label class="form__group__content" data-text="timeObservationModal">
                        </label>
                        <span id="deleteObservationName" class="form__group__value"></span>
                    </div>
                    <p class="form__group__content" data-text="messageDelete"></p>

                    <div class="form__group__buttons">
                        <button type="button" class="btn btn-secondary form__button__back" data-bs-dismiss="modal"
                            data-text="cancelButton"></button>
                        <button type="submit" class="btn btn-danger form__button__close"
                            data-text="deleteButton"></button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
