<section class="modal fade modal-common modal__management" id="createSpecie" tabindex="-1"
    aria-labelledby="modalLabelNuevo" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="modalLabelNuevo" data-text="newSpecie"></h2>

            <article class="form">
                <form method="POST" action="{{ route('species.store', ['language' => app()->getLocale()]) }}">
                    @csrf
                    <div class="form__group">
                        <label for="common_name" class="form__group__content" data-text="commonNameModal">
                        </label>
                        <input type="text" class="form__group__input" id="common_name" name="common_name"
                            placeholder="Example: Colibrí Esmeralda">
                    </div>
                    <div class="form__group">
                        <label for="scientific_name" class="form__group__content"
                            data-text="scientificNameModal"></label>
                        <input type="text" class="form__group__input" id="scientific_name" name="scientific_name"
                            placeholder="Example: Chlorostilbon maugaeus">
                    </div>
                    <div class="form__group__buttons">
                        <button type="button" class="btn-close form__button__back" data-bs-dismiss="modal"
                            data-text="cancelButton"></button>
                        <button type="submit" class="btn btn-primary form__button__success"
                            data-text="saveButton"></button>
                    </div>
                </form>
            </article>
        </div>
    </div>
</section>
