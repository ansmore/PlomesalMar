<nav class="nav">
    <div class="toggle">
        <label for="toggle-menu-checkbox">
            <img src="{{ asset('img/hamburger-menu.png') }}" alt="Menu hamburger">
        </label>
    </div>
    <input type="checkbox" class="toggle__checkbox" id="toggle-menu-checkbox">
    <div class="navbar">
        <div class="navbar__logo">
            <a href="{{ route('home') }}">
                <img class="img-responsive" src="{{ asset('img/logos/pymesoft_logo_text.png') }}" alt="Pymesoft"
                    id="pymeso" />
            </a>
        </div>
        <div class="navbar__menu">
            <ul class="list">
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('home') }}" value-text="navHomePage"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('digitalizacion.section', ['section' => 'que-es']) }}"
                        value-text="navService"></a>
                    {{-- digitalizacion#services --}}
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('digitalizacion.section', ['section' => 'agente']) }}"
                        value-text="navAgente"></a>
                    {{-- digitalizacion#agente --}}
                </li>
                <li class="list__item">
                    <a class="list__item__link"
                        href="{{ route('digitalizacion.section', ['section' => 'requisitos']) }}"
                        value-text="navRequisitos"></a>
                    {{-- digitalizacion#requisitos --}}
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('digitalizacion.section', ['section' => 'bono']) }}"
                        value-text="navBono"></a>
                    {{-- digitalizacion#bono --}}
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('digitalizacion.section', ['section' => 'faq']) }}"
                        value-text="navFaq"></a>
                    {{-- digitalizacion#faq --}}
                </li>
            </ul>
        </div>
        <div class="navbar__language">
            <ul class="list">
                <li class="list__item">
                    <div class="dropdown">
                        <a class="list__item__link" id="navModulosDropdown" role="button">CAS</a>
                        <div class="dropdown__menu" aria-labelledby="navModulosDropdown">
                            <a class="dropdown__menu__item" href="#">CASTELLANO</a>
                            <a class="dropdown__menu__item" href="#">ENGLISH</a>
                            <a class="dropdown__menu__item" href="#">FRANÇAIS</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigationDigitalizacion.js') }}" defer></script>
