@extends('layouts.main')

@section('title', 'Inicio')
@section('content')

    @include('components.navigationHome')
    {{-- @include('components.header') --}}

    <div class="main">
        <!-- Services Section -->
        <section id="soluciones" class="solutions">
            <div class="solutions__row">
                <div class="box--title">
                    <h2 class="box__title" value-text="homeSoluciones"></h2>
                    <h3 class="box__content--title" value-text="homeServicesSubheading"></h3>
                </div>
            </div>
            <div class="solutions__row1">
                <div class="box">
                    <span class="box__icon">
                        <span class="fa fa-circle fa-stack-2x text-primary"></span>
                        <span class="fa fa-check-square-o  fa-stack-1x fa-inverse">
                            <i class="fas fa-check-square"></i>
                        </span>
                    </span>
                    <h4 class="box__content">
                        <a href="{{ route('biit') }}" value-text="services1"></a>
                    </h4>
                </div>
                <div class="box">
                    <span class="box__icon">
                        <span class="fa fa-circle fa-stack-2x text-primary"></span>
                        <span class="fa fa-list-ul cart fa-stack-1x fa-inverse"></span>
                    </span>
                    <h4 class="box__content">
                        <a href="{{ route('consultoria') }}" value-text="services3"></a>
                    </h4>
                </div>
            </div>
            <div class="solutions__row2">
                <div class="box">
                    <span class="box__icon">
                        <span class="fa fa-circle  fa-stack-2x text-primary"></span>
                        <span class="fa fa-shopping-cart fa-stack-1x fa-inverse"></span>
                    </span>
                    <h4 class="box__content">
                        <a href="{{ route('biit') }}" value-text="services4"></a>
                    </h4>
                </div>
                <div class="box">
                    <span class="box__icon">
                        <span class="fa fa-circle fa-stack-2x text-primary"></span>
                        <span class="fa fa-briefcase fa-stack-1x fa-inverse"></span>
                    </span>
                    <h4 class="box__content">
                        <a href="{{ route('biit') }}" value-text="services5"></a>
                    </h4>
                </div>
            </div>
        </section>
        <!-- Clients Aside -->
        <section class="aside">
            <div class="aside__box">
                <a href="{{ route('biit') }}">
                    <img src="img/logos/banner.jpg" class="img-responsive img-centered" alt="banner">
                </a>
            </div>
        </section>
        <!-- About Section -->
        <section id="about" class="about">
            <div class="about__row">
                <div class="box">
                    <h2 class="box__title" value-text="aboutHeading"></h2>

                    <h4 class="box__content" value-text="aboutText"></h4>
                    <a href="{{ route('biit') }}" class="box__button" value-text="aboutButton"></a>
                </div>
            </div>
        </section>

        <!-- Sitemap & Contact Section -->
        <!-- Contact-Custom -->
        <section id="contact" class="contact">
            <div class="contact__row">
                <div class="box--title">
                    <h2 class="box__title" value-text="sitemapHeading"></h2>
                    <h3 class="box__content">
                        <span class="fa fa-map-marker" value-text="sitemapAddress"></span>
                    </h3>
                </div>
            </div>
            <div class="contact_row" id="overlay"> <!-- Obtener clave API -->
                <iframe class="box__map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2984.8365965213275!2d2.079309315088584!3d41.572780979247604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a494c6bf0218b9%3A0xfb5a922369909333!2sPymesoft+Vall%C3%A9s+S.L.!5e0!3m2!1ses!2ses!4v1515689921450"
                    frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="contact_row">
                <div class="box">
                    <h2 class="box__title" value-text="contactHeading"></h2>
                </div>
                <div class="box">
                    <h3 class="box__content" value-text="contactPhone">
                    </h3>
                    <h4 class="box__content" value-text="contactPhoneNumber">
                    </h4>
                    {{-- <span class="box__icon"> </span> --}}
                </div>
                <div class="box">
                    <h3 class="box__content" value-text="contactAction"></h3>
                    <a href="{{ route('biit') }}" class="box__button" value-text="contactActionMessage"></a>
                </div>
            </div>
    </div>
    {{-- <div class="contact-text box">
                    <div class="patata box">
                        <form id="contact-form" class="form box" action="#" method="POST" role="form">
                            <div class="form-group box">
                                <label class="form-label" for="name" value-text="contactName"></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nombre" tabindex="1" required>
                            </div>
                            <div class="form-group box">
                                <label class="form-label" for="email" value-text="contactEmail"></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" tabindex="2" required>
                            </div>
                            <div class="form-group box">
                                <label class="form-label" for="phone" value-text="contactTelephone"></label>
                                <input type="tel" class="form-control" id="phone" name="phone" maxlength="9"
                                    placeholder="Telèfono" tabindex="3" required>
                            </div>
                            <div class="form-group box">
                                <label class="form-label" for="message" value-text="contactMessage"></label>
                                <textarea rows="5" cols="50" name="message" class="form-control" id="message"
                                    placeholder="Mensaje..." tabindex="4" required></textarea>
                            </div>
                            <div class="box">
                                <p class = 'clausulaContacto' value-text="contactoClausulaContacto"></p>
                                <p class = 'clausulaContacto' value-text="contactoClausulaContacto2"></p>
                            </div>
                            <div class="form-group text-center box">
                                <input id = 'checkboxAceptacion' class = 'checkboxAceptacion' type='checkbox'
                                    name='aceptacion' />
                                <div>
                                    <span class = 'mensajeAceptacion' value-text="contactAccept"></span>
                                    <a href="#" data-toggle="modal" data-target="#politica"
                                        value-text="contactPolitica"></a>
                                    <span class = 'mensajeAceptacion' value-text="contactAccept2"></span>
                                    <a href="#" data-toggle="modal" data-target="#terminos"
                                        value-text="contactUse"></a>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-start-order button-formulario"
                                    value-text="contactButton"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
    </section>
    </div>
    <script type="module" src="{{ asset('js/home.js') }}" defer></script>
@endsection
