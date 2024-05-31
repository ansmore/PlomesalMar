{{-- Id-> table-container Can't be deleted --}}

<div class="card" id="table-container">
    <table class="table">
        <thead class="text-white">
            <tr>
                <th scope="col">
                    <span data-text="timeObservation" class="table__title"></span>
                    <a href="?orderByField=time&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=time&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col" data-text="waypoint" class="mq__remove1"></th>
                <th scope="col">
                    <span data-text="individuals" class="table__title"></span>
                    <a href="?orderByField=number_of_individuals&orderByDirection=asc" class="decoration">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                    <a href="?orderByField=number_of_individuals&orderByDirection=desc" class="decoration">
                        <i class="fas fa-arrow-down"></i>
                    </a>
                </th>
                <th scope="col" data-text="image"></th>
                <th scope="col" data-text="flight" class="mq__remove2"></th>
                <th scope="col" data-text="distance" class="mq__remove2"></th>
                @if (Auth::user()->hasRole('validator', 'admin'))
                    <th scope="col" data-text="actions" class="table__title"></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($observations as $observation)
                <tr>
                    <td>{{ $observation->time }}</td>
                    <td class="mq__remove1">{{ $observation->waypoint }}</td>
                    <td>{{ $observation->number_of_individuals }}</td>
                    <td>
                        @if ($observation->firstImage)
                            <picture class="contenedorImagen">
                                <source media="(max-width: 799px)"
                                    srcset="{{ $observation->firstImage->getUrl('small') }}?{{ \Illuminate\Support\Str::random(8) }}"
                                    loading="lazy">
                                <source media="(min-width: 800px) and (max-width: 1023px)"
                                    srcset="{{ $observation->firstImage->getUrl('medium') }}?{{ \Illuminate\Support\Str::random(8) }}"
                                    loading="lazy">
                                <img src="{{ $observation->firstImage->getUrl('large') }}?{{ \Illuminate\Support\Str::random(8) }}"
                                    loading="lazy" class="img-fluid">
                            </picture>
                        @else
                            No images
                        @endif
                    </td>
                    <td class="mq__remove2">
                        @if ($observation->in_flight)
                            <i class="fas fa-check" style="font-size: 1.5rem;"></i>
                        @else
                            <i class="fas fa-close" style="font-size: 1.5rem;"></i>
                        @endif
                    </td>
                    <td class="mq__remove2">
                        @if ($observation->distance_under_300m)
                            <i class="fas fa-check" style="font-size: 1.5rem;"></i>
                        @else
                            <i class="fas fa-close" style="font-size: 1.5rem;"></i>
                        @endif
                    </td>
                    @if (Auth::user()->hasRole('validator', 'admin'))
                        <td class="iconsImage">
                            <form
                                action="{{ route('observations.observation.show', ['language' => app()->getLocale(), 'observation' => $observation->id]) }}"
                                method="GET" style="display: inline;">
                                <button type="submit" class="buttonTable__success">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </form>
                            <form
                                action="{{ route('observations.observation.edit', ['language' => app()->getLocale(), 'observation' => $observation->id]) }}"
                                method="GET" style="display: inline;">
                                <button type="submit" class="buttonTable__success">
                                    <i class="fas fa-pencil"></i>
                                </button>
                            </form>
                            @if (Auth::user()->hasRole('admin'))
                                <button type="button" class="buttonTable__close" data-bs-toggle="modal"
                                    data-bs-target="deleteObservationModal" data-id="{{ $observation->id }}"
                                    data-name="{{ $observation->time }}" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('modals/observations.delete')
</div>
<div id="image-popup" class="image-popup">
    <img src="" alt="Large view">
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

{{-- No Borrar --}}
<style>
    .contenedorImagen img {
        width: 100%;
        height: auto;
        max-width: 5rem;
        cursor: pointer;
    }

    .image-popup {
        display: none;
        position: absolute;
        z-index: 1000;
        max-width: 20rem;
    }

    .image-popup img {
        width: 100%;
        height: auto;
    }
</style>
