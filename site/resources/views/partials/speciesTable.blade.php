<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
            <tr>
                <th scope="col">
                    <span data-text="commonName" class="table__title"></span>
                    <a href="?orderByField=common_name&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=common_name&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col">
                    <span data-text="scientificName" class="table__title"></span>
                    <a href="?orderByField=scientific_name&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=scientific_name&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col" data-text="actions" class="table__title"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($species as $specie)
                <tr>
                    <td>{{ $specie->common_name }}</td>
                    <td>{{ $specie->scientific_name }}</td>
                    <td class="icon-center">
                        <button type="button" class="buttonTable__success" data-bs-toggle="modal"
                            data-bs-target="#edit{{ $specie->id }}" title="Editar">
                            <i class="fas fa-pencil"></i>
                        </button>
                        <button type="button" class="buttonTable__danger" data-bs-toggle="modal"
                            data-bs-target="#delete{{ $specie->id }}" title="Eliminar">
                            <i class="fas fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
                {{-- @include('species.info')
                            @include('species.delete') --}}
            @endforeach
        </tbody>
    </table>
    {{-- </div> --}}
</div>
<nav aria-label="Page navigation example" class="pagination__box">
    <ul class="pagination">
        <li class="page-item {{ $species->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $species->previousPageUrl() }}" data-text="back"></a>
        </li>

        <li class="page-item {{ $species->currentPage() == 1 ? 'active' : '' }}">
            <a class="page-link" href="{{ $species->url(1) }}">1</a>
        </li>

        @if ($species->currentPage() > 3)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @for ($i = max(2, $species->currentPage() - 1); $i <= min($species->lastPage() - 1, $species->currentPage() + 1); $i++)
            <li class="page-item {{ $species->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $species->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($species->currentPage() < $species->lastPage() - 2)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif

        @if ($species->lastPage() > 1)
            <li class="page-item {{ $species->currentPage() == $species->lastPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $species->url($species->lastPage()) }}">{{ $species->lastPage() }}</a>
            </li>
        @endif

        <li class="page-item {{ $species->currentPage() == $species->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $species->nextPageUrl() }}" data-text="next"></a>
        </li>
    </ul>
</nav>
