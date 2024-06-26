<section class="modal fade modal-common modal__management__big danger" id="deleteUsersModal" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__big__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar"><i
                class="fa-solid fa-xmark"></i></button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="deleteModalLabel" data-text="confirmDelete"></h2>

            <article class="form">
                <form id="deleteUsersForm" action="" method="POST"
                    data-delete-url-template="{{ route('admin.user.destroy', [':id', 'language' => app()->getLocale()]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="form__group">
                        <label class="form__group__content" data-text="nameModal"></label>
                        <span class="form__group__value" id="deleteName"></span>
                    </div>
                    <div class="form__group">
                        <label class="form__group__content" data-text="surnameModal"></label>
                        <span class="form__group__value" id="deleteSurname"></span>
                    </div>
                    <div class="form__group">
                        <label class="form__group__content" data-text="surnameSecondModal"></label>
                        <span class="form__group__value" id="deleteSurnameSecond"></span>
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
