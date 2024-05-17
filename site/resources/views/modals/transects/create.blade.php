<section class="modal fade modal-common modal__management" id="createTransect" tabindex="-1"
    aria-labelledby="modalLabelNuevo" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="modalLabelNuevo" data-text="newTransect"></h2>
            <article class="form">
                <form method="POST" action="{{ route('transects.store', ['language' => app()->getLocale()]) }}">
                    @csrf
                    <div class="form__group">
                        <label for="transectName" class="form__group__content" data-text="transectsNameModal">
                        </label>
                        <input type="text" class="form__group__input" id="transectName" name="name"
                            placeholder="Example: 35º">
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
