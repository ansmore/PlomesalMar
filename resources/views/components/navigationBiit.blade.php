<nav class="nav">
    <div class="toggle">
        <label for="toggle-menu-checkbox">
            <img src="{{ asset('img/hamburger-menu.png') }}" alt="Menu hamburger">
        </label>
    </div>
    <input type="checkbox" class="toggle__checkbox" id="toggle-menu-checkbox">
    <div class="navbar">
        <div class="navbar__logo">
            <a href="{{ route('biit', ['language' => $language]) }}">
                <img class="img-responsive" src="{{ asset('./img/logos/logo_biit.png') }}" alt="Pymesoft"
                    id="pymeso" />
            </a>
        </div>
        <div class="navbar__menu">
            <ul class="list">
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('home', ['language' => $language]) }}"
                        value-text="navHomePage"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('whyBiit', ['language' => $language]) }}"
                        value-text="navBiit"></a>
                </li>
                <li class="list__item">
                    <div class="dropdown">
                        <a class="list__item__link" id="navModulosDropdown" role="button" value-text="navModulos">
                        </a>
                        <div class="dropdown__menu" aria-labelledby="navModulosDropdown">
                            <a class="dropdown__menu__item"
                                href="{{ route('biitModules.section', ['section' => 'management', 'language' => $language]) }}"
                                value-text="navGestion"></a>
                            <a class="dropdown__menu__item"
                                href="{{ route('biitModules.section', ['section' => 'trade', 'language' => $language]) }}"
                                value-text="navComercio"></a>
                            <a class="dropdown__menu__item"
                                href="{{ route('biitModules.section', ['section' => 'process', 'language' => $language]) }}"
                                value-text="navProceso"></a>
                            <a class="dropdown__menu__item"
                                href="{{ route('biitModules.section', ['section' => 'bill', 'language' => $language]) }}"
                                value-text="navFactura"></a>
                            <a class="dropdown__menu__item"
                                href="{{ route('biitModules.section', ['section' => 'business', 'language' => $language]) }}"
                                value-text="navBusiness"></a>
                        </div>
                    </div>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('biitContact', ['language' => $language]) }}"
                        value-text="navContacto"></a>
                    {{-- Pendiente de hacer la pagina de contacto --}}
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
                            <a id="es" value-text="cas" class="dropdown__menu__item" href="#"></a>
                            <a id="ca" value-text="cat" class="dropdown__menu__item" href="#"></a>
                            <a id="en" value-text="eng" class="dropdown__menu__item" href="#"></a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/components/navigation.js') }}" defer></script>
