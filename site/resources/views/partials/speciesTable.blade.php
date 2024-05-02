{{-- Id-> table-container Can't be deleted --}}

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
                            data-bs-target="#editSpecies{{ $specie->id }}" title="Editar">
                            <i class="fas fa-pencil"></i>
                        </button>
                        <button type="button" class="buttonTable__danger" data-bs-toggle="modal"
                            data-bs-target="#deleteSpecies{{ $specie->id }}" title="Eliminar">
                            <i class="fas fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
                @include('modals/species.edit')
                @include('modals/species.delete')
            @endforeach
        </tbody>
    </table>
</div>
<nav aria-label="Page navigation example" class="pagination__box">
    {{-- Aquest canvi?  --}}
    {{-- <ul class="pagination">
        <!-- Botón Anterior -->
        @if ($species->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">
                    <i class="fa-solid fa-arrow-left"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $species->previousPageUrl() }}" rel="prev">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </li>
        @endif

        <!-- Números de Página -->
        @foreach ($species->getUrlRange(1, $species->lastPage()) as $page => $url)
            <li class="page-item {{ $species->currentPage() == $page ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach

        <!-- Botón Siguiente -->
        @if ($species->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $species->nextPageUrl() }}" rel="next">
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </li>
        @endif
    </ul> --}}

    <ul class="pagination">
        <li class="page-item {{ $species->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $species->previousPageUrl() }}">Back</a>
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
            <a class="page-link" href="{{ $species->nextPageUrl() }}">Next</a>
        </li>
    </ul>
</nav>

{{--
@push('scripts')
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
@endpush --}}
