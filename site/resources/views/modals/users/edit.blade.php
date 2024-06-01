<section class="modal fade modal-common modal__management__big" id="editUsersModal" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__big__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="editModalLabel" data-text="editUser"></h2>

            <article class="form">
                <form id="editUsersForm" action="" method="POST"
                    data-edit-url-template="{{ route('admin.user.update', [':id', 'language' => app()->getLocale()]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form__group">
                        <label for="edit_user_name" class="form__group__content" data-text="nameModal"></label>
                        <input type="text" class="form-control form__group__input" id="edit_user_name" name="name"
                            value="" />
                    </div>
                    <div class="form__group">
                        <label for="edit_user_surname" class="form__group__content" data-text="surnameModal"></label>
                        <input type="text" class="form__group__input" id="edit_user_surname" name="surname" />
                    </div>
                    <div class="form__group">
                        <label for="edit_user_surnameSecond" class="form__group__content"
                            data-text="surnameSecondModal"></label>
                        <input type="text" class="form-control form__group__input" id="edit_user_surnameSecond"
                            name="surnameSecond" />
                    </div>
                    <div class="form__group">
                        <label for="edit_user_email" class="form__group__content" data-text="emailModal"></label>
                        <input type="text" class="form__group__input" id="edit_user_email" name="email"
                            value="" />
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
