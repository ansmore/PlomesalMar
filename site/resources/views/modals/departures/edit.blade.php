<section class="modal fade modal-common modal__management__big" id="editDepartureModal" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__big__box">
        <button type="button" class="btn-close btn-close-white close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="modal-content body">
            <h2 class="modal-title body__title" id="editModalLabel" data-text="editDeparture"></h2>

            <article class="modal-header bg-info text-white form">
                <form id="editDepartureForm" action="" method="POST"
                    data-edit-url-template="{{ route('departures.update', [':id', 'language' => app()->getLocale()]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body form__group">
                        <label for="boat_name" class="form__group__content" data-text="boatNameModal"></label>
                        <input type="text" class="form-control form__group__input" id="transectName" name="name"
                            value="" />
                    </div>
                    <div class="modal-body form__group">
                        <label for="transect_name" class="form__group__content" data-text="transectNameModal"></label>
                        <input type="text" class="form-control form__group__input" id="transectName" name="name"
                            value="" />
                    </div>
                    <div class="modal-body form__group">
                        <label for="date" class="form__group__content" data-text="dateModal"></label>
                        <input type="text" class="form-control form__group__input" id="transectName" name="name"
                            value="" />
                    </div>
                    <div class="form__group__buttons">
                        <button type="button" class="btn btn-secondary form__button__back" data-bs-dismiss="modal"
                            data-text="cancelButton"></button>
                        <button type="submit" class="btn btn-primary form__button__success"
                            data-text="saveButton"></button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
