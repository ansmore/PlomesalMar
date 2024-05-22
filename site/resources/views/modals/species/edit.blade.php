<section class="modal fade modal-common modal__management" id="editSpecieModal" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="modal-content body">
            <h2 class="modal-title body__title" id="editModalLabel" data-text="editSpecie"></h2>

            <article class="modal-header bg-info text-white form">
                <form id="editSpeciesForm" action="" method="POST"
                    data-edit-url-template="{{ route('species.update', [':id', 'language' => app()->getLocale()]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body form__group">
                        <label for="nombreComun" class="form-label  form__group__content"
                            data-text="commonNameModal"></label>
                        <input type="text" class="form-control form__group__input" id="nombreComun"
                            name="common_name" value="" />
                    </div>
                    <div class="form__group">
                        <label for="nombreCientifico" class="form-label form__group__content"
                            data-text="scientificNameModal"></label>
                        <input type="text" class="form-control form__group__input" id="nombreCientifico"
                            name="scientific_name" value="" />
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
