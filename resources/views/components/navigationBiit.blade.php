<nav class="navbar">
    <div class="container">
        <div class="logo--header">
            <a href="{{ route('biit') }}">
                <img class="img-responsive" src="./img/logos/logo_biit.png" alt="Pymesoft" id="pymeso" />
            </a>
        </div>
        <div>
            <div class="logo--nav">
                <ul>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('home') }}" value-text="navHomePage"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('biit') }}" value-text="navInicio"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('biit.section', ['section' => 'porque']) }}"
                            value-text="navBiit"></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link page-scroll dropdown-toggle" id="navModulosDropdown" role="button"
                                value-text="navModulos">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navModulosDropdown">
                                <a class="dropdown-item"
                                    href="{{ route('biitModules.section', ['section' => 'gestion']) }}"
                                    value-text="navGestion"></a>
                                <a class="dropdown-item"
                                    href="{{ route('biitModules.section', ['section' => 'comercio']) }}"
                                    value-text="navComercio"></a>
                                <a class="dropdown-item"
                                    href="{{ route('biitModules.section', ['section' => 'proceso']) }}"
                                    value-text="navProceso"></a>
                                <a class="dropdown-item"
                                    href="{{ route('biitModules.section', ['section' => 'business']) }}"
                                    value-text="navBusiness"></a>
                                <a class="dropdown-item"
                                    href="{{ route('biitModules.section', ['section' => 'factura']) }}"
                                    value-text="navFactura"></a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="{{ route('biitContact') }}" value-text="navContacto"></a>
                        {{-- Pendiente de hacer la pagina de contacto --}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigationBiit.js') }}" defer></script>
