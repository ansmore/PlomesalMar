<nav class="navbar">
    <div class="container">
        <div class="logo--header">
            <a href="/">
                <img class="img-responsive" src="./img/logo.png" alt="Pymesoft" id="pymeso" />
            </a>
        </div>
        <div class="logo--nav">
            <ul>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('home') }}" value-text="navHomePage"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('home') }}" value-text="navHome"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('digitalizacion') }}"
                        value-text="navDigitalizacion"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('home.section', ['section' => 'soluciones']) }}"
                        value-text="navService"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('biit') }}" value-text="navPorfolio"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('home.section', ['section' => 'contact']) }}"
                        value-text="navContact"></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigationHome.js') }}" defer></script>
