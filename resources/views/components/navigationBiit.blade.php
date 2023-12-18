<nav class="nav">
    <div class="toggle">
        <label for="toggle-menu-checkbox">
            <img src="{{ asset('img/hamburger-menu.png') }}" alt="Menu hamburger">
        </label>
    </div>
    <input type="checkbox" class="toggle__checkbox" id="toggle-menu-checkbox">
    <div class="navbar">
        <div class="navbar__logo">
            <a href="{{ route('biit') }}">
                <img class="img-responsive" src="./img/logos/logo_biit.png" alt="Pymesoft" id="pymeso" />
            </a>
        </div>
        <div class="navbar__menu">
            <ul class="list">
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('home') }}" value-text="navHomePage"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('biit') }}" value-text="navInicio"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('biit.section', ['section' => 'porque']) }}"
                        value-text="navBiit"></a>
                </li>
                <li class="list__item">
                    <div class="dropdown">
                        <a class="list__item__link" id="navModulosDropdown" role="button" value-text="navModulos">
                        </a>
                        <div class="dropdown__menu" aria-labelledby="navModulosDropdown">
                            <a class="dropdown__menu__item"
                                href="{{ route('biitModules.section', ['section' => 'gestion']) }}"
                                value-text="navGestion"></a>
                            <a class="dropdown__menu__item"
                                href="{{ route('biitModules.section', ['section' => 'comercio']) }}"
                                value-text="navComercio"></a>
                            <a class="dropdown__menu__item"
                                href="{{ route('biitModules.section', ['section' => 'proceso']) }}"
                                value-text="navProceso"></a>
                            <a class="dropdown__menu__item"
                                href="{{ route('biitModules.section', ['section' => 'business']) }}"
                                value-text="navBusiness"></a>
                            <a class="dropdown__menu__item"
                                href="{{ route('biitModules.section', ['section' => 'factura']) }}"
                                value-text="navFactura"></a>
                        </div>
                    </div>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('biitContact') }}" value-text="navContacto"></a>
                    {{-- Pendiente de hacer la pagina de contacto --}}
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigationBiit.js') }}" defer></script>
