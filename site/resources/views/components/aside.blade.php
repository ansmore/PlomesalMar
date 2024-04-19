<aside class="aside">
    <article class="leftBar">
        <ul class="list">
            <li class="list__item">
                <a href="{{ route('home', ['language' => $language]) }}" class="list__item__link" data-text="navHomePage">
                    {{-- <span >
                        </span> --}}
                </a>
            </li>
            <li class="list__item">
                <a href="{{ route('home', ['language' => $language]) }}">
                    <span class="list__item__link" data-text="navManagement">
                    </span>
                </a>
            </li>
            <li class="list__item">
                <a href="{{ route('home', ['language' => $language]) }}">
                    <span class="list__item__link" data-text="navPorfolio">
                    </span>
                </a>
            </li>
            <li class="list__item">
                <a href="{{ route('plomesalmarContact', ['language' => $language]) }}">
                    <span class="list__item__link" data-text="navContact">
                    </span>
                </a>
            </li>
        </ul>

    </article>
</aside>
