<aside class="aside">
    <nav class="leftBar">
        <ul class="list">
            <li class="list__title">
                <span data-text="asideMenu">
                </span>
            </li>
            <li class="list__item">
                <span class="list__item__icon">
                    <i class="fas fa-globe">
                    </i>
                </span>
                <a href="{{ route('departures', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideDeparture">
                </a>
            </li>
            <li class="list__item">
                <span class="list__item__icon">
                    <i class="fas fa-binoculars">
                    </i>
                </span>
                <a href="{{ route('species', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideObservation"></a>
            </li>
            <li class="list__item">
                <span class="list__item__icon">
                    <i class="fas fa-crow">
                    </i>
                </span>
                <a href="{{ route('species', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideSpecie">
                </a>
            </li>
            <li class="list__item">
                <span class="list__item__icon">
                    <i class="fas fa-ship">
                    </i>
                </span>
                <a href="{{ route('boats', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideBoat">
                </a>
            </li>
            <li class="list__item">
                <span class="list__item__icon">
                    <i class="fas fa-location">
                    </i>
                </span>
                <a href="{{ route('transects', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideTransect">
                </a>
            </li>
            {{-- <li class="list__item">
                <span class="list__item__icon">
                    <i class="fas fa-camera">
                    </i>
                </span>
                <a href="{{ route('species', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideImage">
                </a>
            </li> --}}
            <li class="list__title">
                <span data-text="asideDashboard">
                </span>
            </li>
            <li class="list__item">
                <span class="list__item__icon">
                    <i class="fas fa-globe">
                    </i>
                </span>
                <a href="{{ route('dashboard.graph1', ['language' => $language]) }}" class="list__item__link"
                    data-text="graph1">
                </a>
            </li>
        </ul>
    </nav>
</aside>


@push('scripts')
    <script type="module" src="{{ asset('js/components/aside.js') }}" defer></script>
@endpush
