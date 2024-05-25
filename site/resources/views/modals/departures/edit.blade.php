<section class="modal fade modal-common modal__management__big" id="editDepartureModal" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__big__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="editModalLabel" data-text="editDeparture"></h2>

            <article class="form">
                <form id="editDepartureForm" action="" method="POST"
                    data-edit-url-template="{{ route('departures.update', [':id', 'language' => app()->getLocale()]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form__group">
                        <label for="edit_boat_id" class="form__group__content" data-text="boatNameModal"></label>
                        <select class="form__group__select" name="boat_id" id="edit_boat_id">
                            @foreach ($boats as $boat)
                                <option value="{{ $boat->id }}">{{ $boat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form__group">
                        <label for="edit_transect_id" class="form__group__content"
                            data-text="transectNameModal"></label>
                        <select class="form__group__select" name="transect_id" id="edit_transect_id">
                            @foreach ($transects as $transect)
                                <option value="{{ $transect->id }}">{{ $transect->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form__group">
                        <label for="edit_date" class="form__group__content" data-text="dateModal"></label>
                        <input type="date" class="form__group__input" id="edit_date" name="date">
                    </div>

                    <!-- New div with user checkboxes -->
                    <div class="form__group">
                        <label for="edit_users" class="form__group__content">Select Users:</label>
                        <div class="form__group__grid form__group__grid--scroll" id="edit_users">
                            @foreach ($users as $user)
                                <div class="form__group__checkbox">
                                    <input type="checkbox" id="edit_user_{{ $user->id }}" name="users[]"
                                        value="{{ $user->id }}">
                                    <label for="edit_user_{{ $user->id }}">{{ $user->name }}</label>
                                </div>
                            @endforeach
                        </div>
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
