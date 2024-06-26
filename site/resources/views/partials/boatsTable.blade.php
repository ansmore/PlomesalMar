<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
            <tr>
                <th scope="col">
                    <span data-text="boatName" class="table__title"></span>
                    <a href="?orderByField=name&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=name&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col">
                    <span data-text="boatsRegistrationPlate" class="table__title"></span>
                    <a href="?orderByField=registration_number&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=registration_number&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                @if (Auth::user()->hasRole('validator', 'admin'))
                    <th scope="col" data-text="actions" class="table__title"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($boats as $boat)
                <tr>
                    <td>{{ $boat->name }}</td>
                    <td>{{ $boat->registration_number }}</td>
                    @if (Auth::user()->hasRole('validator', 'admin'))
                        <td class="icons">
                            <button type="button" class="buttonTable__success" data-bs-toggle="modal"
                                data-bs-target="editBoatModal" title="Editar" data-id="{{ $boat->id }}"
                                data-name="{{ $boat->name }}"
                                data-registration-number="{{ $boat->registration_number }}">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('modals/boats.edit')
</div>

<nav aria-label="Page navigation example" class="pagination__box">
    <ul class="pagination">
        <li class="page-item {{ $boats->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $boats->previousPageUrl() }}">Back</a>
        </li>

        <li class="page-item {{ $boats->currentPage() == 1 ? 'active' : '' }}">
            <a class="page-link" href="{{ $boats->url(1) }}">1</a>
        </li>

        @if ($boats->currentPage() > 3)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @for ($i = max(2, $boats->currentPage() - 1); $i <= min($boats->lastPage() - 1, $boats->currentPage() + 1); $i++)
            <li class="page-item {{ $boats->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $boats->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($boats->currentPage() < $boats->lastPage() - 2)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @if ($boats->lastPage() > 1)
            <li class="page-item {{ $boats->currentPage() == $boats->lastPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $boats->url($boats->lastPage()) }}">{{ $boats->lastPage() }}</a>
            </li>
        @endif

        <li class="page-item {{ $boats->currentPage() == $boats->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $boats->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>
