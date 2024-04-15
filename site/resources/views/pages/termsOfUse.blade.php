@extends('layouts.main')

@section('title', 'Terms of Use')
@section('content')

    @include('components.navigationHome')

    <div class="main">
        <!-- Header  section -->
        <section id="header__birds" class="termsAndPolicy">
            <div class="termsAndPolicy__row">
                <div class="circles">
                    <span class="circles__pyme">
                        <a href="{{ route('home', ['language' => $language]) }}">
                            <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                        </a>
                    </span>
                    <span class="circles__birds">
                        <a href="{{ route('home', ['language' => $language]) }}">
                            <img src="{{ asset('../img/logos/logo_blue.jpeg') }}" alt="">
                        </a>
                    </span>
                </div>
            </div>
        </section>
        <section class="termsAndPolicy">
            <div class="termsAndPolicy__row">
                <h2 data-text="termsHeader" class="box__title"></h2>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span data-text="termsIntroA" class="box__content"></span>
                </article>

            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <div class="info">
                        <div class="info__column__left">
                            <span data-text="termsIntroBTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span data-text="termsName" class="box__name"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span data-text="termsIntroCTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span data-text="termsIntroC" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span data-text="termsIntroDTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span data-text="termsIntroD" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span data-text="termsIntroETitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span data-text="termsIntroE" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span data-text="termsIntroFTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span data-text="termsIntroF" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span data-text="termsIntroGTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span data-text="termsIntroG" class="box__company"></span>
                        </div>
                    </div>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="termsObjectHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="termsName" class="box__name"></span>
                        <span data-text="termsObjectA" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="termsObjectB" class="box__content"></span>
                        <span data-text="termsName" class="box__name"></span>
                        <span data-text="termsObjectC" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="termsObjectD" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="termsObjectE" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="conditions" class="box__subtitle"></p>
                    <p data-text="characterHeader" class="box__subtitle__secondary"></p>
                    <div>
                        <span data-text="character" class="box__content"></span>
                        <span data-text="termsName" class="box__name"></span>
                        <span data-text="character2" class="box__content"></span>
                    </div>
                    <p data-text="registerHeader" class="box__subtitle__secondary"></p>
                    <div>
                        <span data-text="register" class="box__content"></span>
                    </div>
                    <p data-text="veracityHeader" class="box__subtitle__secondary"></p>
                    <div>
                        <span data-text="veracity" class="box__content"></span>
                        <span data-text="termsName" class="box__name"></span>
                        <span data-text="veracity2" class="box__content"></span>
                    </div>
                    <p data-text="minorsHeader" class="box__subtitle__secondary"></p>
                    <div>
                        <span data-text="minors" class="box__content"></span>
                    </div>
                    <p data-text="obligationHeader" class="box__subtitle__secondary"></p>
                    <div>
                        <p>
                            <span data-text="obligation1" class="box__content"></span>
                        </p>
                        <p>
                            <span data-text="obligation2" class="box__content"></span>
                        </p>
                        <p>
                            <span data-text="obligation3" class="box__content"></span>
                        </p>

                        <p>
                            <span data-text="obligation4" class="box__content"></span>
                        </p>
                        <p>
                            <span data-text="obligation5" class="box__content"></span>
                        </p>
                        <p>
                            <span data-text="obligation6" class="box__content"></span>
                        </p>
                        <p>
                            <span data-text="obligation7" class="box__content"></span>
                        </p>
                        <p>
                            <span data-text="obligation8" class="box__content"></span>
                        </p>
                    </div>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="exclusionHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="exclusion" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="exclusion2" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="termsName" class="box__name"></span>
                        <span data-text="exclusion3" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="exclusion4" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="cookiesHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="cookies" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="linksHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="links" class="box__content"></span>
                        <span data-text="termsName" class="box__name"></span>
                        <span data-text="links2" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="links3" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="protectionHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="protection" class="box__content"></span>
                        <a data-text="privacypolicy" class="box__name"
                            href="{{ route('privacyPolicy', ['language' => $language]) }}"></a>

                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="socialMediaHeader" class="box__subtitle"></p>
                    <p>
                        <span data-text="socialMedia" class="box__content"></span>
                        <span data-text="termsName" class="box__name"></span>
                        <span data-text="socialMedia2" class="box__content"></span>
                        <span data-text="termsName" class="box__name"></span>
                        <span data-text="socialMedia3" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="socialMedia4" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="socialMedia5" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="socialMedia6" class="box__content"></span>
                        <span data-text="termsName" class="box__name"></span>
                        <span data-text="socialMedia7" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="socialMedia8" class="box__content"></span>
                    </p>
                    <p>
                        <span data-text="socialMedia9" class="box__content"></span>
                        <span data-text="termsName" class="box__name"></span>
                        <span data-text="socialMedia10" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="propietyHeader" class="box__subtitle"></p>
                    <p data-text="propiety" class="box__content"></p>
                    <p data-text="propiety3" class="box__content"></p>
                    <p data-text="propiety4" class="box__content"></p>
                    <p data-text="propiety5" class="box__content"></p>
                    <p data-text="propiety6" class="box__content"></p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p data-text="lawHeader" class="box__subtitle"></p>
                    <p data-text="law" class="box__content"></p>
                </article>
            </div>
        </section>
    </div>
    <script type="module" src="{{ asset('js/pages/termsAndPolicy.js') }}" defer></script>
@endsection
