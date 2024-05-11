<header>
    <nav class="nav">
        <div class="toggle">
            <label for="toggle-menu-checkbox">
                <i class="fa-solid fa-bars"></i>
            </label>
        </div>
        <input type="checkbox" class="toggle__checkbox" id="toggle-menu-checkbox">
        <div class="navbar">
            <div class="navbar__logo">
                <a href="/">
                    <img src="{{ asset('../img/logos/logo_navbar.jpeg') }}" alt="plomesalamar" id="pymeso">
                </a>
            </div>
            <div class="navbar__menu__home">
                <ul class="list">
                    <li class="list__item">
                        <a href="{{ route('home', ['language' => $language]) }}" class="list__item__link"
                            data-text="navHomePage"></a>
                    </li>
                    <li class="list__item">
                        <a href="{{ route('management', ['language' => $language]) }}" class="list__item__link"
                            data-text="navManagement"></a>
                    </li>
                    <li class="list__item">
                        <a href="{{ route('home', ['language' => $language]) }}" class="list__item__link"
                            data-text="navPorfolio"></a>
                    </li>
                    <li class="list__item">
                        <a href="{{ route('plomesalmarContact', ['language' => $language]) }}" class="list__item__link"
                            data-text="navContact"></a>
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
                                        <a class="dropdown__menu__item"
                                            href="{{ route('home', ['language' => $language]) }}" role="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <span data-text="hello"></span>
                                            <span> {{ Auth::user()->name }}</span>
                                        </a>
                                    </span>
                                    <span>
                                        <a href="{{ route('admin.index', ['language' => $language]) }}"
                                            class="dropdown__menu__item">
                                            <span data-text="administration"></span>
                                        </a>
                                    </span>
                                    <span>
                                        <a class="dropdown__menu__item"
                                            href="{{ route('logout', ['language' => $language]) }}"
                                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                            <span data-text="logout"></span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout', ['language' => $language]) }}"
                                            method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </span>
                                @endguest
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
</header>


@push('scripts')
    <script type="module" src="{{ asset('js/components/navigation.js') }}" defer></script>
@endpush
