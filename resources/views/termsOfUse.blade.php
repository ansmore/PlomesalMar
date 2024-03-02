@extends('layouts.main')

@section('title', 'Biit')
@section('content')

    @include('components.navigationHome')

    <div class="main">
        <!-- Header  section -->
        <section id="header__biit" class="termsAndPolicy">
            <div class="termsAndPolicy__row">
                <div class="circle">
                    <span class="circle__pyme">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('../img/logos/pymesoft_logo_text.png') }}" alt="">
                        </a>
                    </span>
                    <span class="circle__biit">
                        <a href="{{ route('biit') }}">
                            <img src="{{ asset('img/logos/logo_biit.png') }}" alt="">
                        </a>
                    </span>
                </div>
            </div>
        </section>
        <section class="termsAndPolicy">
            <div class="termsAndPolicy__row">
                <h2 value-text="termsHeader" class="box__title"></h2>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <span value-text="termsIntroA" class="box__content"></span>
                </article>

            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroBTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsName" class="box__name"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroCTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsIntroC" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroDTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsIntroD" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroETitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsIntroE" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroFTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsIntroF" class="box__company"></span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="info__column__left">
                            <span value-text="termsIntroGTitle" class="box__content"></span>
                        </div>
                        <div class="info__column__right">
                            <span value-text="termsIntroG" class="box__company"></span>
                        </div>
                    </div>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="termsObjectHeader" class="box__subtitle"></p>
                    <p>
                        <span value-text="termsName" class="box__name"></span>
                        <span value-text="termsObjectA" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="termsObjectB" class="box__content"></span>
                        <span value-text="termsName" class="box__name"></span>
                        <span value-text="termsObjectC" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="termsObjectD" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="termsObjectE" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="conditions" class="box__subtitle"></p>
                    <p value-text="characterHeader" class="box__subtitle__secondary"></p>
                    <div>
                        <span value-text="character" class="box__content"></span>
                        <span value-text="termsName" class="box__name"></span>
                        <span value-text="character2" class="box__content"></span>
                    </div>
                    <p value-text="registerHeader" class="box__subtitle__secondary"></p>
                    <div>
                        <span value-text="register" class="box__content"></span>
                    </div>
                    <p value-text="veracityHeader" class="box__subtitle__secondary"></p>
                    <div>
                        <span value-text="veracity" class="box__content"></span>
                        <span value-text="termsName" class="box__name"></span>
                        <span value-text="veracity2" class="box__content"></span>
                    </div>
                    <p value-text="minorsHeader" class="box__subtitle__secondary"></p>
                    <div>
                        <span value-text="minors" class="box__content"></span>
                    </div>
                    <p value-text="obligationHeader" class="box__subtitle__secondary"></p>
                    <div>
                        <p>
                            <span value-text="obligation1" class="box__content"></span>
                        </p>
                        <p>
                            <span value-text="obligation2" class="box__content"></span>
                        </p>
                        <p>
                            <span value-text="obligation3" class="box__content"></span>
                        </p>

                        <p>
                            <span value-text="obligation4" class="box__content"></span>
                        </p>
                        <p>
                            <span value-text="obligation5" class="box__content"></span>
                        </p>
                        <p>
                            <span value-text="obligation6" class="box__content"></span>
                        </p>
                        <p>
                            <span value-text="obligation7" class="box__content"></span>
                        </p>
                        <p>
                            <span value-text="obligation8" class="box__content"></span>
                        </p>
                    </div>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="exclusionHeader" class="box__subtitle"></p>
                    <p>
                        <span value-text="exclusion" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="exclusion2" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="termsName" class="box__name"></span>
                        <span value-text="exclusion3" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="exclusion4" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="cookiesHeader" class="box__subtitle"></p>
                    <p>
                        <span value-text="cookies" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="linksHeader" class="box__subtitle"></p>
                    <p>
                        <span value-text="links" class="box__content"></span>
                        <span value-text="termsName" class="box__name"></span>
                        <span value-text="links2" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="links3" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="protectionHeader" class="box__subtitle"></p>
                    <p>
                        <span value-text="protection" class="box__content"></span>
                        <a value-text="privacypolicy" class="box__name"
                            href="{{ route('privacyPolicy', ['language' => $language]) }}"></a>

                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="socialMediaHeader" class="box__subtitle"></p>
                    <p>
                        <span value-text="socialMedia" class="box__content"></span>
                        <span value-text="termsName" class="box__name"></span>
                        <span value-text="socialMedia2" class="box__content"></span>
                        <span value-text="termsName" class="box__name"></span>
                        <span value-text="socialMedia3" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="socialMedia4" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="socialMedia5" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="socialMedia6" class="box__content"></span>
                        <span value-text="termsName" class="box__name"></span>
                        <span value-text="socialMedia7" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="socialMedia8" class="box__content"></span>
                    </p>
                    <p>
                        <span value-text="socialMedia9" class="box__content"></span>
                        <span value-text="termsName" class="box__name"></span>
                        <span value-text="socialMedia10" class="box__content"></span>
                    </p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="propietyHeader" class="box__subtitle"></p>
                    <p value-text="propiety" class="box__content"></p>
                    <p value-text="propiety3" class="box__content"></p>
                    <p value-text="propiety4" class="box__content"></p>
                    <p value-text="propiety5" class="box__content"></p>
                    <p value-text="propiety6" class="box__content"></p>
                </article>
            </div>
            <div class="termsAndPolicy__row">
                <article class="box">
                    <p value-text="lawHeader" class="box__subtitle"></p>
                    <p value-text="law" class="box__content"></p>
                </article>
            </div>
        </section>
    </div>
    <script type="module" src="{{ asset('js/whyBiit.js') }}" defer></script>
@endsection
