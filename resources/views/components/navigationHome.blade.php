<nav class="navbar">
    <div class="container">
        <div class="navbar__logo">
            <a href="/">
                <img class="img-responsive" src="./img/logo.png" alt="Pymesoft" id="pymeso" />
            </a>
        </div>
        <div class="navbar__menu">
            <div class="toggle-menu">
                <label for="toggle-menu-checkbox">
                    <img src="{{ asset('img/hamburger-menu.png') }}" alt="Menu hamburger">
                </label>
            </div>
            <input type="checkbox" class="toggle-menu__checkbox" id="toggle-menu-checkbox">
            <ul class="navbar__list">
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('home') }}" value-text="navHomePage"></a>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('digitalizacion') }}" value-text="navDigitalizacion"></a>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('home.section', ['section' => 'soluciones']) }}"
                        value-text="navService"></a>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('biit') }}" value-text="navPorfolio"></a>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('home.section', ['section' => 'contact']) }}"
                        value-text="navContact"></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigationHome.js') }}" defer></script>
