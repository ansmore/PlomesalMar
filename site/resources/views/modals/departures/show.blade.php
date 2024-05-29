<section class="modal fade modal-common modal__management__big" id="detailsDepartureModal" tabindex="-1"
    aria-labelledby="detailsModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__big__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="detailsModalLabel" data-text="detailsDeparture"></h2>

            <article class="form">
                <div class="form__group">
                    <label class="form__group__content" data-text="boatNameModal"></label>
                    <p id="details_boat_name" class="form__group__value"></p>
                </div>
                <div class="form__group">
                    <label class="form__group__content" data-text="transectNameModal"></label>
                    <p id="details_transect_name" class="form__group__value"></p>
                </div>
                <div class="form__group">
                    <label class="form__group__content" data-text="dateModal"></label>
                    <p id="details_date" class="form__group__value"></p>
                </div>
                <div class="form__group">
                    <label class="form__group__content">Observers:</label>
                    <ul id="details_observers" class="form__group__box"></ul>
                </div>
                <div class="form__group__buttons">
                    <button type="button" class="btn-close form__button__back" data-bs-dismiss="modal"
                        data-text="cancelButton"></button>
                </div>
            </article>
        </div>
    </div>
</section>
