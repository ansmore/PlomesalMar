<?php

$language = Session::get('language', 'ca1');
// echo "Footer -> $language";
?>
<footer class="footer">
    <section class="row">
        <article class="box">
            <picture class="box__image">
                <a href="{{ route('home', ['language' => $language]) }}">
                    <img src="{{ asset('../img/logos/demo.png') }}" alt="plomesalamar" id="plomesalamar">
                </a>
            </picture>
        </article>
        <article class="box__row">
            <span data-text="footerCopyright"></span>
            <span data-text="footerName"></span>
            <span>{{ date('Y') }}</span>
        </article>
    </section>
    <section class="row">
        <article class="box">
            <ul>
                <li class="icon__item">
                    <a class="icon__item__link" href="https://twitter.com/plomesalamarValles">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                </li>
                <li class="icon__item">
                    <a class="icon__item__link" href="https://www.facebook.com/plomesalamar-Valles-sl-205440757738">
                        <i class="fab fa-facebook"></i>
                    </a>
                </li>
                <li class="icon__item">
                    <a class="icon__item__link" href="https://es.linkedin.com/company/plomesalamar-vall-s">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </li>
            </ul>
        </article>
        <article class="box__row">
            <span class="box__content">
                <a class="list__item__link" href="{{ route('privacyPolicy', ['language' => $language]) }}"
                    data-toggle="modal" data-target="#politica" data-text="footerPolitica"></a>
            </span>
            <span class="box__content">
                <a class="list__item__link" href="{{ route('termsOfUse', ['language' => $language]) }}"
                    data-toggle="modal" data-target="#terminos" data-text="footerUse"></a>
            </span>
        </article>
    </section>
</footer>
<script type="module" src="{{ asset('js/components/footer.js') }}" defer></script>
