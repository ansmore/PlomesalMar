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
                    <a class="nav-link page-scroll"
                        href="{{ route('digitalizacion.section', ['section' => 'servicios']) }}"
                        value-text="navService"></a>
                    {{-- digitalizacion#services --}}
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll"
                        href="{{ route('digitalizacion.section', ['section' => 'agente']) }}"
                        value-text="navAgente"></a>
                    {{-- digitalizacion#agente --}}
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll"
                        href="{{ route('digitalizacion.section', ['section' => 'requisitos']) }}"
                        value-text="navRequisitos"></a>
                    {{-- digitalizacion#requisitos --}}
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('digitalizacion.section', ['section' => 'bono']) }}"
                        value-text="navBono"></a>
                    {{-- digitalizacion#bono --}}
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('digitalizacion.section', ['section' => 'faq']) }}"
                        value-text="navFaq"></a>
                    {{-- digitalizacion#faq --}}
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigationDigitalizacion.js') }}"></script>
