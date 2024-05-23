{{-- Id-> table-container Can't be deleted --}}

<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
            <tr>
                <th scope="col">
                    <span data-text="time" class="table__title"></span>
                    <a href="?orderByField=time&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=time&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col" data-text="waypoint"></th>
                <th scope="col">
                    <span data-text="individuals" class="table__title"></span>
                    <a href="?orderByField=number_of_individuals&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=number_of_individuals&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col" data-text="flight"></th>
                <th scope="col" data-text="distance"></th>
                <th scope="col" data-text="actions" class="table__title"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($observations as $observation)
                <tr>
                    <td>{{ $observation->time }}</td>
                    <td>{{ $observation->waypoint }}</td>
                    <td>{{ $observation->number_of_individuals }}</td>
                    <td>
                        @if ($observation->in_flight)
                            <i class="fas fa-check" style="font-size: 1.5rem;"></i>
                        @else
                            <i class="fas fa-close" style="font-size: 1.5rem;"></i>
                        @endif
                    </td>
                    <td>
                        @if ($observation->distance_under_300m)
                            <i class="fas fa-check" style="font-size: 1.5rem;"></i>
                        @else
                            <i class="fas fa-close" style="font-size: 1.5rem;"></i>
                        @endif
                    </td>
                    <td class="icons">
                        <button type="button" class="buttonTable__success" data-bs-toggle="modal"
                            data-bs-target="editobservationsModal" title="Editar" data-id="{{ $observation->id }}"
                            data-common-name="{{ $observation->common_name }}"
                            data-scientific-name="{{ $observation->scientific_name }}">
                            <i class="fas fa-pencil"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- @include('modals/observations.edit') --}}
</div>

<nav aria-label="Page navigation example" class="pagination__box">
    <ul class="pagination">
        <li class="page-item {{ $observations->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $observations->previousPageUrl() }}">Back</a>
        </li>

        <li class="page-item {{ $observations->currentPage() == 1 ? 'active' : '' }}">
            <a class="page-link" href="{{ $observations->url(1) }}">1</a>
        </li>

        @if ($observations->currentPage() > 3)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @for ($i = max(2, $observations->currentPage() - 1); $i <= min($observations->lastPage() - 1, $observations->currentPage() + 1); $i++)
            <li class="page-item {{ $observations->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $observations->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($observations->currentPage() < $observations->lastPage() - 2)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @if ($observations->lastPage() > 1)
            <li class="page-item {{ $observations->currentPage() == $observations->lastPage() ? 'active' : '' }}">
                <a class="page-link"
                    href="{{ $observations->url($observations->lastPage()) }}">{{ $observations->lastPage() }}</a>
            </li>
        @endif

        <li class="page-item {{ $observations->currentPage() == $observations->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $observations->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
