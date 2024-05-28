<section class="modal fade modal-common modal__management__big" id="createDeparture" tabindex="-1"
    aria-labelledby="modalLabelNuevo" aria-hidden="true">

    <div class="modal-dialog modal-lg modal__management__big__box">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Cerrar">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-header body">
            <h2 class="modal-title body__title" id="modalLabelNuevo" data-text="newDeparture"></h2>

            <article class="form">
                <form method="POST" action="{{ route('departures.store', ['language' => app()->getLocale()]) }}">
                    @csrf
                    <div class="form__group">
                        <label for="boat_id" class="form__group__content" data-text="boatNameModal"></label>
                        <select class="form__group__select" name="boat_id" id="boat_id">
                            @foreach ($boats as $boat)
                                <option value="{{ $boat->id }}">{{ $boat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form__group">
                        <label for="transect_id" class="form__group__content" data-text="transectNameModal"></label>
                        <select class="form__group__select" name="transect_id" id="transect_id">
                            @foreach ($transects as $transect)
                                <option value="{{ $transect->id }}">{{ $transect->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form__group">
                        <label for="date" class="form__group__content" data-text="dateModal"></label>
                        <input type="date" class="form__group__input" id="date" name="date">
                    </div>

                    <!-- New div with user checkboxes -->
                    <div class="form__group">
                        <label for="users" class="form__group__content">Select Users:</label>
                        <div class="form__group__grid form__group__grid--scroll">
                            @foreach ($users as $user)
                                <div class="form__group__checkbox">
                                    <input type="checkbox" id="user_{{ $user->id }}" name="users[]"
                                        value="{{ $user->id }}">
                                    <label for="user_{{ $user->id }}">{{ $user->name }}</label>
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

<!-- Add some custom styles for grid layout -->
<style>
    .form__group__grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        max-height: calc(3* 50px);
        overflow-y: auto;
        margin-bottom: 2rem;
        border: 1px solid #0065AE;
        border-radius: 0.25rem;
        padding: 0.5rem;
        margin-left: 0.25rem;
    }

    .form__group__checkbox {
        display: flex;
        align-items: center;
        appearance: auto;
    }

    .form__group__checkbox input {
        margin-right: 10px;
        appearance: auto;
    }
</style>
