{{-- Id-> table-container Can't be deleted --}}

<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
            <tr>
                <th scope="col">
                    <span data-text="boatName" class="table__title"></span>
                    <a href="?orderByField=boat_id&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=boat_id&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col">
                    <span data-text="transectName" class="table__title"></span>
                    <a href="?orderByField=transect_id&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=transect_id&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col">
                    <span data-text="date" class="table__title"></span>
                </th>
                @if (Auth::user()->hasRole('validator', 'admin'))
                    <th scope="col" data-text="actions" class="table__title"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($departures as $departure)
                {{-- @dd($departure) --}}
                <tr>
                    <td>{{ $departure->boat?->name }}</td>
                    <td>{{ $departure->transect?->name }}</td>
                    <td>{{ $departure->date }}</td>
                    @if (Auth::user()->hasRole('validator', 'admin'))
                        <td class="icons">
                            <button type="button" class="buttonTable__success" data-bs-toggle="modal"
                                data-bs-target="detailsDepartureModal" title="Detalles" data-id="{{ $departure->id }}"
                                data-boat-name="{{ $departure->boat->name }}"
                                data-transect-name="{{ $departure->transect->name }}" data-date="{{ $departure->date }}"
                                data-observers="{{ implode(', ', $departure->observers) }}">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button type="button" class="buttonTable__success" data-bs-toggle="modal"
                                data-bs-target="editDepartureModal" title="Editar" data-id="{{ $departure->id }}"
                                data-boat-id="{{ $departure->boat_id }}"
                                data-transect-id="{{ $departure->transect_id }}" data-date="{{ $departure->date }}"
                                data-observers="{{ implode(', ', $departure->observers) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            @if (Auth::user()->hasRole('admin'))
                                <button type="button" class="buttonTable__close" data-bs-toggle="modal"
                                    data-bs-target="deleteDepartureModal" data-id="{{ $departure->id }}"
                                    data-name="{{ $departure->date }}" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif


                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('modals/departures.show')
    @include('modals/departures.edit')
    @include('modals/departures.delete')
</div>

<nav aria-label="Page navigation example" class="pagination__box">
    <ul class="pagination">
        <li class="page-item {{ $departures->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $departures->previousPageUrl() }}">Back</a>
        </li>

        <li class="page-item {{ $departures->currentPage() == 1 ? 'active' : '' }}">
            <a class="page-link" href="{{ $departures->url(1) }}">1</a>
        </li>

        @if ($departures->currentPage() > 3)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @for ($i = max(2, $departures->currentPage() - 1); $i <= min($departures->lastPage() - 1, $departures->currentPage() + 1); $i++)
            <li class="page-item {{ $departures->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $departures->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($departures->currentPage() < $departures->lastPage() - 2)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @if ($departures->lastPage() > 1)
            <li class="page-item {{ $departures->currentPage() == $departures->lastPage() ? 'active' : '' }}">
                <a class="page-link"
                    href="{{ $departures->url($departures->lastPage()) }}">{{ $departures->lastPage() }}</a>
            </li>
        @endif

        <li class="page-item {{ $departures->currentPage() == $departures->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $departures->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
