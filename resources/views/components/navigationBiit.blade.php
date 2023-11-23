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
                        <p class="nav-link page-scroll dropdown-toggle" id="navModulosDropdown" role="button"
                            value-text="navModulos">Mo0dulos
                        </p>
                        <div class="dropdown-menu" aria-labelledby="navModulosDropdown">
                            <a class="dropdown-item" href="{{ route('biit.section', ['section' => 1]) }}">Sección 1</a>
                            <a class="dropdown-item" href="{{ route('biit.section', ['section' => 2]) }}">Sección 2</a>
                            <a class="dropdown-item" href="{{ route('biit.section', ['section' => 3]) }}">Sección 3</a>
                            <a class="dropdown-item" href="{{ route('biit.section', ['section' => 4]) }}">Sección 4</a>
                            <a class="dropdown-item" href="{{ route('biit.section', ['section' => 5]) }}">Sección 5</a>
                            <a class="dropdown-item" href="{{ route('biit.section', ['section' => 6]) }}">Sección 6</a>
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
