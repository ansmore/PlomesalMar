<section class="modal fade modal-common modal__management" id="createDeparture" tabindex="-1"
    aria-labelledby="modalLabelNuevo" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="modalLabelNuevo" data-text="newDeparture"></h2>

            <article class="form">
                <form method="POST" action="{{ route('departures.store', ['language' => app()->getLocale()]) }}">
                    @csrf
                    <div class="form__group">
                        <label for="boatId" class="form__group__content" data-text="boatId"></label>
                        <input type="text" class="form__group__input" id="boatId" name="boat_id"
                            placeholder="ID del barco">
                    </div>
                    <div class="form__group">
                        <label for="transectId" class="form__group__content" data-text="transectId"></label>
                        <input type="text" class="form__group__input" id="transectId" name="transect_id"
                            placeholder="ID del transecto">
                    </div>
                    <div class="form__group">
                        <label for="date" class="form__group__content" data-text="date"></label>
                        <input type="date" class="form__group__input" id="date" name="date">
                    </div>
                    <div class="form__group">
                        <label for="time" class="form__group__content" data-text="time"></label>
                        <input type="time" class="form__group__input" id="time" name="time">
                    </div>
                    <div class="form__group__buttons">
                        <button type="button" class="btn-close form__button__back" data-bs-dismiss="modal"
                            data-text="cancelButton"></button>
                        <button type="submit" class="btn btn-primary form__button" data-text="saveButton"></button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
