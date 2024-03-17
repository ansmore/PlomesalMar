<footer class="footer">
    <section class="row">
        <article class="box">
            <picture class="box__image">
                <img src="{{ asset('../img/logos/pymesoft_logo_text.png') }}" alt="Pymesoft" id="pymesoft" />
            </picture>
        </article>
        <article class="box__row">
            <span value-text="footerCopyright"></span>
            <span value-text="footerName"></span>
            <span>{{ date('Y') }}</span>
        </article>
    </section>
    <section class="row">
        <article class="box">
            <ul>
                <li class="icon__item">
                    <a class="icon__item__link" href="https://twitter.com/PymesoftValles">
                        <i class="fa-brands fa-x-twitter">
                        </i>
                    </a>
                </li>
                <li class="box__icon__item">
                    <a class="box__icon__item__link" href="https://www.facebook.com/Pymesoft-Valles-sl-205440757738">
                        <i class="fab fa-facebook"></i>
                    </a>
                </li>
                <li class="box__icon__item">
                    <a class="box__icon__item__link" href="https://es.linkedin.com/company/pymesoft-vall-s">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </li>
            </ul>
        </article>
        <article class="box__row">
            <span class="box__content">
                <a class="list__item__link" href="{{ route('privacyPolicy', ['language' => $language]) }}"
                    data-toggle="modal" data-target="#politica" value-text="footerPolitica"></a>
            </span>
            <span class="box__content">
                <a class="list__item__link" href="{{ route('termsOfUse', ['language' => $language]) }}"
                    data-toggle="modal" data-target="#terminos" value-text="footerUse"></a>
            </span>
        </article>
    </section>
</footer>
<script type="module" src="{{ asset('js/footer.js') }}" defer></script>
