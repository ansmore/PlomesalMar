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
                    <a class="nav-link page-scroll" href="{{ route('home') }}" value-text="navHome"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('digitalizacion') }}"
                        value-text="navDigitalizacion"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('home.section', ['section' => 'services']) }}"
                        value-text="navService"></a>
                    {{-- /#services --}}
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="http://biit.es/" value-text="navPorfolio"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('home.section', ['section' => 'site']) }}"
                        value-text="navLocation"></a>
                    {{-- /#site --}}
                </li>
                <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{ route('home.section', ['section' => 'contact']) }}"
                        value-text="navContact"></a>
                    {{-- /#contact --}}
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/navigationHome.js') }}"></script>
