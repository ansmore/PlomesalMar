<footer class="footer">
    <section class="logo">
        <div class="logo__image">
            <picture>
                <img class="img-responsive" src="./img/logos/Pymesoft_logo.png" alt="Pymesoft" id="pymeso" />
            </picture>
        </div>
        <div class="logo__row">
            <div class="col-md-4">
                <span> &copy;</span>
                <span class="copyright" value-text="footerCopyright"></span>
                <span><?php echo date('Y'); ?></span>
            </div>
        </div>
    </section>
    <section class="Social">
        <div class="Social__row">
            <ul class="list">
                <li class="list__item">
                    <a class="list__item__link" href="https://twitter.com/PymesoftValles">
                        <i class="fab fa-twitter"></i></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="https://www.facebook.com/Pymesoft-Valles-sl-205440757738"><i
                            class="fab fa-facebook"></i></a>
                </li>
                <li class="list__item">
                    <a class="list__item__link" href="https://es.linkedin.com/company/pymesoft-vall-s"><i
                            class="fab fa-linkedin"></i></a>
                </li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul class="list-inline quicklinks">
                <li>
                    <a href="#" data-toggle="modal" data-target="#politica" value-text="footerPolitica"></a>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#terminos" value-text="footerUse"></a>
                </li>
            </ul>
        </div>

        </div>
</footer>
<script type="module" src="{{ asset('js/footer.js') }}" defer></script>
