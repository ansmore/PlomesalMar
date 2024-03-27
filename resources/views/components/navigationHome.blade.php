{{-- <?php

$language = Session::get('language', 'ca');

?> --}}
<nav class="nav">
    <div class="toggle">
        <label for="toggle-menu-checkbox">
            <img src="{{ asset('img/hamburger-menu.png') }}" alt="Menu hamburger">
        </label>
    </div>
    <input type="checkbox" class="toggle__checkbox" id="toggle-menu-checkbox">
    <div class="navbar">
        <div class="navbar__logo">
            <a href="/">
                <img src="{{ asset('../img/logos/demo.png') }}" alt="Pymesoft" id="pymeso">
            </a>
        </div>
        <div class="navbar__menu__home">
            <ul class="list">
                <li class="list__item">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <span class="list__item__link" data-text="navHomePage">
                        </span>
                    </a>
                </li>
                <li class="list__item">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <span class="list__item__link" data-text="navDigitalization">
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
                    <a href="{{ route('birdsContact', ['language' => $language]) }}">
                        <span class="list__item__link" data-text="navContact">
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar__language">
            <ul class="list">
                <li class="list__item">
                    <div class="dropdown">
                        <a class="list__item__link" id="navModulosDropdown" role="button"
                            data-text="currentLanguage"></a>
                        <div id="setLanguages" class="dropdown__menu" aria-labelledby="navModulosDropdown">
                            <a id="ca" class="dropdown__menu__item" href="#">
                                <span data-text="cat">
                                </span>
                            </a>
                            <a id="en" class="dropdown__menu__item" href="#">
                                <span data-text="eng">
                                </span>
                            </a>
                            <a id="es" class="dropdown__menu__item" href="#">
                                <span data-text="cas">
                                </span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/components/navigation.js') }}" defer></script>
