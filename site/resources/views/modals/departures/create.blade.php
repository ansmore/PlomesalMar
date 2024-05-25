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
                    {{-- <div class="form__group">
                        <label for="boat_name" class="form__group__content" data-text="boatNameModal"></label>
                        <select class="form__group__select" name="boat_id" id="boat_id">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form__group">
                        <label for="date" class="form__group__content" data-text="dateModal"></label>
                        <input type="date" class="form__group__input" id="date" name="date">
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
