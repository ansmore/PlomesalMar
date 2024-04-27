<nav class="nav">
    <div class="navbar">
        <div class="navbar__logo">
            <a href="/">
                <img src="{{ asset('../img/logos/logo_navbar.jpeg') }}" alt="plomesalamar" id="pymeso">
            </a>
        </div>
        <div class="navbar__toggle">
            <label for="toggle-menu-checkbox">
                <img src="{{ asset('img/hamburger-menu.png') }}" alt="Menu hamburger">
            </label>
        </div>
        <input type="checkbox" class="navbar__toggle__checkbox" id="toggle-menu-checkbox">
        <div class="navbar__menu__home">
            <ul class="list">
                <li class="list__item">
                    <a href="{{ route('home', ['language' => $language]) }}" class="list__item__link"
                        data-text="navHomePage">
                        {{-- <span >
                        </span> --}}
                    </a>
                </li>
                <li class="list__item">
                    <a href="{{ route('management', ['language' => $language]) }}">
                        <span class="list__item__link" data-text="navManagement">
                        </span>
                    </a>
                </li>
                <li class="list__item">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <span class="list__item__link" data-text="navPorfolio">
                        </span>
                    </a>
                </li>
                <li class="list__item">
                    <a href="{{ route('plomesalmarContact', ['language' => $language]) }}">
                        <span class="list__item__link" data-text="navContact">
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar__auth">
            <ul class="list">
                <li class="list__item">
                    <div class="dropdown">
                        <a class="list__item__link" id="navModulosDropdown" role="button" data-text="">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <div id="userAuth" class="dropdown__menu" aria-labelledby="navModulosDropdown">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <span class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('login', ['language' => $language]) }}">{{ __('Login') }}</a>
                                    </span>
                                @endif
                                @if (Route::has('register'))
                                    <span class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('register', ['language' => $language]) }}">{{ __('Register') }}</a>
                                    </span>
                                @endif
                            @else
                                <span>
                                    {{-- Deleted id from a, pending to review -> id="navbarDropdown" --}}
                                    <a class="dropdown__menu__item" href="{{ route('home', ['language' => $language]) }}"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        v-pre>
                                        <span data-text="hello"></span>
                                        <span> {{ Auth::user()->name }}</span>
                                    </a>
                                </span>
                                <span>
                                    <a class="dropdown__menu__item" href="{{ route('logout', ['language' => $language]) }}"
                                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout', ['language' => $language]) }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </span>
                            @endguest
                            {{-- <a id="ca" data-text="cat" class="dropdown__menu__item" href="#"></a> --}}
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="navbar__language">
            <ul class="list">
                <li class="list__item">
                    <div class="dropdown">
                        <a class="list__item__link" id="navModulosDropdown" role="button"
                            data-text="currentLanguage"></a>
                        <div id="setLanguages" class="dropdown__menu" aria-labelledby="navModulosDropdown">
                            <a id="ca" data-text="cat" class="dropdown__menu__item" href="#"></a>
                            <a id="es" data-text="cas" class="dropdown__menu__item" href="#"></a>
                            <a id="en" data-text="eng" class="dropdown__menu__item" href="#"></a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('scripts')
    <script type="module" src="{{ asset('js/components/navigation.js') }}" defer></script>
@endpush
