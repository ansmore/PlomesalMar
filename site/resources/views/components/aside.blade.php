<aside class="aside">
    <article class="leftBar">
        <ul class="list">
            <li class="list__title">
                <span data-text="asideManagement">
                </span>
            </li>
            <li class="list__item">
                <i class="fas fa-globe">
                </i>
                <a href="{{ route('home', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideDeparture">
                </a>
            </li>
            <li class="list__item">
                <i class="fas fa-binoculars">
                </i>
                <a href="{{ route('home', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideObservation"></a>
            </li>
            <li class="list__item">
                <i class="fas fa-crow">
                </i>
                <a href="{{ route('species', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideSpecie">
                </a>
            </li>
            <li class="list__item">
                <i class="fas fa-ship">
                </i>
                <a href="{{ route('home', ['language' => $language]) }}" class="list__item__link" data-text="asideBoat">
                </a>
            </li>
            <li class="list__item">
                <i class="fas fa-location">
                </i>
                <a href="{{ route('plomesalmarContact', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideTransect">
                </a>
            </li>
            <li class="list__item">
                <i class="fas fa-camera">
                </i>
                <a href="{{ route('home', ['language' => $language]) }}" class="list__item__link"
                    data-text="asideImage">
                </a>
            </li>
        </ul>
    </article>
</aside>
