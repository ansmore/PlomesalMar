<?php

$language = Session::get('language', 'ca');

?>
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
                <img src="{{ asset('../img/logos/pymesoft_logo_text.png') }}" alt="Pymesoft" id="pymeso" />
            </a>
        </div>
        <div class="navbar__menu">
            <ul class="list">
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('home', ['language' => $language]) }}"
                        value-text="navHomePage"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('digitalization', ['language' => $language]) }}"
                        value-text="navDigitalization"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('biit', ['language' => $language]) }}"
                        value-text="navPorfolio"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link"
                        href="{{ route('home.section', ['section' => 'contact', 'language' => $language]) }}"
                        value-text="navContact"></a>
                </li>
            </ul>
        </div>
        <div class="navbar__language">
            <ul class="list">
                <li class="list__item">
                    <div class="dropdown">
                        <a class="list__item__link" id="navModulosDropdown" role="button"
                            value-text="currentLanguage"></a>
                        <div id="setLanguages" class="dropdown__menu" aria-labelledby="navModulosDropdown">
                            <a id="es" value-text="cas" class="dropdown__menu__item" href="#"
                                {{-- onclick="changeLanguage('es')" --}}></a>
                            <a id="ca" value-text="cat" class="dropdown__menu__item" href="#"
                                {{-- onclick="changeLanguage('ca')" --}}></a>
                            <a id="en" value-text="eng" class="dropdown__menu__item" href="#"
                                {{-- onclick="changeLanguage('en')" --}}></a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/components/navigation.js') }}" defer></script>
