<nav class="navbar">
    <div class="container">
        <div class="navbar__logo">
            <a href="{{ route('home') }}">
                <img class="img-responsive" src="./img/logo.png" alt="Pymesoft" id="pymeso" />
            </a>
        </div>
        <div class="navbar__menu">
            <ul class="navbar__list">
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('home') }}" value-text="navHomePage"></a>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('digitalizacion.section', ['section' => 'que-es']) }}"
                        value-text="navService"></a>
                    {{-- digitalizacion#services --}}
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('digitalizacion.section', ['section' => 'agente']) }}"
                        value-text="navAgente"></a>
                    {{-- digitalizacion#agente --}}
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('digitalizacion.section', ['section' => 'requisitos']) }}"
                        value-text="navRequisitos"></a>
                    {{-- digitalizacion#requisitos --}}
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('digitalizacion.section', ['section' => 'bono']) }}"
                        value-text="navBono"></a>
                    {{-- digitalizacion#bono --}}
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('digitalizacion.section', ['section' => 'faq']) }}"
                        value-text="navFaq"></a>
                    {{-- digitalizacion#faq --}}
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigationDigitalizacion.js') }}" defer></script>
