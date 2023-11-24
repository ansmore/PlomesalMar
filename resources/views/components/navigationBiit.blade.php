<nav class="navbar">
    <div class="container">
        <div class="logo--header">
            <a href="{{ route('biit') }}">
                <img class="img-responsive" src="./img/logos/logo_biit.png" alt="Pymesoft" id="pymeso" />
            </a>
        </div>
        <div class="logo--nav">
            <ul>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('biit') }}" value-text="navInicio"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('biit.section', ['section' => 'biit']) }}"
                        value-text="navBiit"></a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link page-scroll dropdown-toggle" id="navModulosDropdown" role="button"
                            value-text="navModulos">Mo0dulos
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navModulosDropdown">
                            <a class="dropdown-item" href="{{ route('biitmodulos.section', ['section' => 'gestion']) }}"
                                value-text="navGestion"></a>
                            <a class="dropdown-item"
                                href="{{ route('biitmodulos.section', ['section' => 'comercio']) }}"
                                value-text="navComercio"></a>
                            <a class="dropdown-item" href="{{ route('biitmodulos.section', ['section' => 'proceso']) }}"
                                value-text="navProceso"></a>
                            <a class="dropdown-item"
                                href="{{ route('biitmodulos.section', ['section' => 'business']) }}"
                                value-text="navBusiness"></a>
                            <a class="dropdown-item" href="{{ route('biitmodulos.section', ['section' => 'factura']) }}"
                                value-text="navFactura"></a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('biit') }}" value-text="navContacto"></a>
                    {{-- Pendiente de hacer la pagina de contacto --}}
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigationBiit.js') }}"></script>
