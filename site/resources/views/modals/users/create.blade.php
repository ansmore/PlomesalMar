<section class="modal fade modal-common modal__management" id="createUser" tabindex="-1" aria-labelledby="modalLabelNuevo"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="modalLabelNuevo" data-text="newUser"></h2>
            <article class="form">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.user.store', ['language' => app()->getLocale()]) }}">
                    @csrf
                    <div class="form__group">
                        <label for="name" class="form__group__content" data-text="nameModal"></label>
                        <input type="text" class="form__group__input" id="name" name="name"
                            placeholder="Nombre">
                    </div>
                    <div class="form__group">
                        <label for="surname" class="form__group__content" data-text="surnameModal"></label>
                        <input type="text" class="form__group__input" id="surname" name="surname"
                            placeholder="Promer cognom">
                    </div>
                    <div class="form__group">
                        <label for="surnameSecond" class="form__group__content" data-text="secondSurnameModal"></label>
                        <input type="text" class="form__group__input" id="surnameSecond" name="surnameSecond"
                            placeholder="Segon cognom">
                    </div>
                    <div class="form__group">
                        <label for="email" class="form__group__content" data-text="emailModal"></label>
                        <input type="email" class="form__group__input" id="email" name="email"
                            placeholder="Email">
                    </div>
                    <div class="form__group">
                        <label for="password" class="form__group__content" data-text="passwordModal"></label>
                        <input type="password" class="form__group__input" id="password" name="password"
                            placeholder="Password">
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
