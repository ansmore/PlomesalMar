<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
            <tr>
                <th scope="col">
                    <span data-text="transectsName" class="table__title"></span>
                    <a href="?orderByField=name&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=name&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col" data-text="actions" class="table__title"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transects as $transect)
                <tr>
                    <td>{{ $transect->name }}</td>
                    <td class="icons">
                        <button type="button" class="buttonTable__success" data-bs-toggle="modal"
                            data-bs-target="#editTransectModal" title="Editar" data-id="{{ $transect->id }}"
                            data-name="{{ $transect->name }}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="buttonTable__info" data-bs-toggle="modal"
                            data-bs-target="#detailsTransectModal" title="Detalles" data-id="{{ $transect->id }}"
                            data-name="{{ $transect->name }}">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('modals/transects.show')
</div>

<nav aria-label="Page navigation example" class="pagination__box">
    <ul class="pagination">
        <li class="page-item {{ $transects->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $transects->previousPageUrl() }}">Back</a>
        </li>

        <li class="page-item {{ $transects->currentPage() == 1 ? 'active' : '' }}">
            <a class="page-link" href="{{ $transects->url(1) }}">1</a>
        </li>

        @if ($transects->currentPage() > 3)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @for ($i = max(2, $transects->currentPage() - 1); $i <= min($transects->lastPage() - 1, $transects->currentPage() + 1); $i++)
            <li class="page-item {{ $transects->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $transects->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($transects->currentPage() < $transects->lastPage() - 2)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @if ($transects->lastPage() > 1)
            <li class="page-item {{ $transects->currentPage() == $transects->lastPage() ? 'active' : '' }}">
                <a class="page-link"
                    href="{{ $transects->url($transects->lastPage()) }}">{{ $transects->lastPage() }}</a>
            </li>
        @endif

        <li class="page-item {{ $transects->currentPage() == $transects->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $transects->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
