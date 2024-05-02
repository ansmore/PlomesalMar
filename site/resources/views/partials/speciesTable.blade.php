{{-- Id-> table-container Can't be deleted --}}

<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
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
        </thead>
        @foreach ($species as $specie)
            <tbody>
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
                @include('modals/species.edit')
                @include('modals/species.delete')
            </tbody>
        @endforeach
    </table>
</div>
<nav aria-label="Page navigation example" class="pagination__box">
    <ul class="pagination">
        <!-- Botón Anterior -->
        @if ($species->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">
                    <i class="fa-solid fa-arrow-left" rel="prev"></i>
                    <span data-text="back" rel="prev"></span>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $species->previousPageUrl() }}">
                    <span data-text="back" rel="prev"></span>
                    <i class="fa-solid fa-arrow-left" rel="prev"></i>
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
                <a class="page-link" href="{{ $species->nextPageUrl() }}">
                    <span data-text="next" rel="next"></span>
                    <i class=" fa-solid fa-arrow-right" rel="next"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" data-text="next"></span>
                <i class="fa-solid fa-arrow-right"></i>
            </li>
        @endif
    </ul>
</nav>

{{--
@push('scripts')
    <script type="module" src="{{ asset('js/partials/table.js') }}" defer></script>
@endpush --}}
