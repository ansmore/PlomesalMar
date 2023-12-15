<nav class="nav">
    <div class="toggle">
        <label for="toggle-menu-checkbox">
            <img src="{{ asset('img/hamburger-menu.png') }}" alt="Menu hamburger">
        </label>
    </div>
    <input type="checkbox" class="toggle__checkbox" id="toggle-menu-checkbox">
    <div class="navbar">
        <div class="navbar__logo">
            <a href="/">
                <img class="img-responsive" src="./img/logos/Pymesoft_logo.png" alt="Pymesoft" id="pymeso" />
            </a>
        </div>
        <div class="navbar__menu">
            <ul class="list">
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('home') }}" value-text="navHomePage"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('digitalizacion') }}" value-text="navDigitalizacion"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('home.section', ['section' => 'soluciones']) }}"
                        value-text="navService"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('biit') }}" value-text="navPorfolio"></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="{{ route('home.section', ['section' => 'contact']) }}"
                        value-text="navContact"></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigationHome.js') }}" defer></script>
