<nav class="navbar">
    <div class="container">
        <div class="logo--header">
            <a href="{{ route('home') }}">
                <img class="img-responsive" src="./img/logo.png" alt="Pymesoft" id="pymeso" />
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
                    <a class="nav-link page-scroll" href="{{ route('biit') }}" value-text="navModulos"></a>
                    {{-- Pendiente de hacer la lista desplegable --}}
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
