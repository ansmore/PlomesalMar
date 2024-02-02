<nav class="nav">
    <div class="toggle">
        <label for="toggle-menu-checkbox">
            <img src="{{ asset('img/hamburger-menu.png') }}" alt="Menu hamburger">
        </label>
    </div>
    <input type="checkbox" class="toggle__checkbox" id="toggle-menu-checkbox">
    <div class="navbar">
        <div class="navbar__logo">
            <a href="{{ route('home', ['language' => $language]) }}">
                <img class="img-responsive" src="{{ asset('../img/logos/pymesoft_logo_text.png') }}" alt="Pymesoft"
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
                    <a class="list__item__link"
                        href="{{ route('digitalization.section', ['section' => 'whatIs', 'language' => $language]) }}"
                        value-text="navService"></a>
                    {{-- digitalization#services --}}
                </li>
                <li class="list__item">
                    <a class="list__item__link"
                        href="{{ route('digitalization.section', ['section' => 'agent', 'language' => $language]) }}"
                        value-text="navAgente"></a>
                    {{-- digitalization#agente --}}
                </li>
                <li class="list__item">
                    <a class="list__item__link"
                        href="{{ route('digitalization.section', ['section' => 'requirements', 'language' => $language]) }}"
                        value-text="navRequisitos"></a>
                    {{-- digitalization#requisitos --}}
                </li>
                <li class="list__item">
                    <a class="list__item__link"
                        href="{{ route('digitalization.section', ['section' => 'bond', 'language' => $language]) }}"
                        value-text="navBono"></a>
                    {{-- digitalization#bono --}}
                </li>
                <li class="list__item">
                    <a class="list__item__link"
                        href="{{ route('digitalization.section', ['section' => 'faq', 'language' => $language]) }}"
                        value-text="navFaq"></a>
                    {{-- digitalization#faq --}}
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
                            <a class="dropdown__menu__item" href="#">CATALÀ</a>
                            <a class="dropdown__menu__item" href="#">ENGLISH</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigation.js') }}" defer></script>