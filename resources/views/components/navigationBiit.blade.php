<nav class="navbar">
    <div class="container">
        <div class="navbar__logo">
            <a href="{{ route('biit') }}">
                <img class="img-responsive" src="./img/logos/logo_biit.png" alt="Pymesoft" id="pymeso" />
            </a>
        </div>
        <div class="navbar__menu">
            <ul class="navbar__list">
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('home') }}" value-text="navHomePage"></a>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('biit') }}" value-text="navInicio"></a>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('biit.section', ['section' => 'porque']) }}"
                        value-text="navBiit"></a>
                </li>
                <li class="navbar__item navbar__item--dropdown">
                    <div class="dropdown">
                        <a class="navbar__link navbar__link--dropdown-toggle" id="navModulosDropdown" role="button"
                            value-text="navModulos">
                        </a>
                        <div class="dropdown__menu" aria-labelledby="navModulosDropdown">
                            <a class="dropdown__item"
                                href="{{ route('biitModules.section', ['section' => 'gestion']) }}"
                                value-text="navGestion"></a>
                            <a class="dropdown__item"
                                href="{{ route('biitModules.section', ['section' => 'comercio']) }}"
                                value-text="navComercio"></a>
                            <a class="dropdown__item"
                                href="{{ route('biitModules.section', ['section' => 'proceso']) }}"
                                value-text="navProceso"></a>
                            <a class="dropdown__item"
                                href="{{ route('biitModules.section', ['section' => 'business']) }}"
                                value-text="navBusiness"></a>
                            <a class="dropdown__item"
                                href="{{ route('biitModules.section', ['section' => 'factura']) }}"
                                value-text="navFactura"></a>
                        </div>
                    </div>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('biitContact') }}" value-text="navContacto"></a>
                    {{-- Pendiente de hacer la pagina de contacto --}}
                </li>
            </ul>
        </div>

    </div>
</nav>
<script type="module" src="{{ asset('js/navigationBiit.js') }}" defer></script>
