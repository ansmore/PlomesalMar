<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
            <tr>
                <th scope="col">
                    <span data-text="boatId" class="table__title"></span>
                    <a href="?orderByField=boat_id&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=boat_id&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col">
                    <span data-text="transectId" class="table__title"></span>
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
                <th scope="col">
                    <span data-text="time" class="table__title"></span>
                </th>
                <th scope="col" data-text="actions" class="table__title"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departures as $departure)
                <tr>
                    <td>{{ $departure->boat?->name }}</td>
                    <td>{{ $departure->transect?->name }}</td>
                    <td>{{ $departure->date }}</td>
                    <td>{{ $departure->time }}</td>
                    <td class="icon-center">
                        <!-- Update these button actions according to the functionalities you want to support for departures -->
                        <button type="button" class="buttonTable__success" data-bs-toggle="modal"
                            data-bs-target="editDepartureModal" title="Editar" data-id="{{ $departure->id }}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="buttonTable__close" data-bs-toggle="modal"
                            data-bs-target="deleteDepartureModal" title="Eliminar" data-id="{{ $departure->id }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Update or create modals for departure actions --}}
    {{-- @include('modals/departures.edit')
    @include('modals/departures.delete') --}}
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
