@extends('layouts.main')

@section('title', 'Inicio')
@section('content')

    @include('components.navigationHome')
    {{-- @include('components.header') --}}

    <div class="main">
        <!-- Services Section -->
        <section id="soluciones">
            <div class="container-services">
                <div class="row">
                    <div>
                        <h2 class="section-heading" value-text="homeSoluciones"></h2>
                        <h3 class="section-subheading text-muted" value-text="homeServicesSubheading"></h3>
                    </div>
                </div>
                <div class="row-1">
                    <div class="row-1-service">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-check-square-o  fa-stack-1x fa-inverse">
                                <i class="fas fa-check-square"></i>
                            </span>
                        </span>
                        <h4 class="service-heading">
                            <a href="{{ route('biit') }}" value-text="services1"></a>
                        </h4>
                    </div>
                    {{-- outsourcing to delete --}}
                    {{-- <div class="row-1-service">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-users fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading" value-text="services2"></h4>
                    </div> --}}
                    <div class="row-1-service">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-list-ul cart fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading">
                            <a href="{{ route('consultoria') }}" value-text="services3"></a>
                        </h4>
                    </div>
                </div>
                <div class="row-2">
                    <div class="row-2-service">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle  fa-stack-2x text-primary"></span>
                            <span class="fa fa-shopping-cart fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading">
                            <a href="{{ route('biit') }}" value-text="services4"></a>
                        </h4>
                    </div>
                    <div class="row-2-service">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-briefcase fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading">
                            <a href="{{ route('biit') }}" value-text="services5"></a>
                        </h4>
                    </div>
                </div>
            </div>
        </section>
        <!-- Clients Aside -->
        <section class="clients">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="{{ route('biit') }}">
                            <img src="img/logos/banner.jpg" class="img-responsive img-centered" alt="banner">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Section -->
        <section class="bg-primary" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading" value-text="aboutHeading"></h2>
                        <hr class="light">
                        <h4 class="text-faded" value-text="aboutText"></h4>
                        <a href="{{ route('biit') }}" class="btn btn-default btn-xl" value-text="aboutButton"></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sitemap & Contact Section -->
        <section id="site">
            <div class="text-center">
                <h2 class="section-heading" value-text="sitemapHeading"></h2>
                <h3 class="section-subheading text-muted">
                    <span class="fa fa-map-marker" value-text="sitemapAddress"></span>
                </h3>
            </div>
            <div id="overlay"> <!-- Obtener clave API -->
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2984.8365965213275!2d2.079309315088584!3d41.572780979247604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a494c6bf0218b9%3A0xfb5a922369909333!2sPymesoft+Vall%C3%A9s+S.L.!5e0!3m2!1ses!2ses!4v1515689921450"
                    width="100%" height="420" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </section>

        <!-- Contact-Custom -->
        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <h2 class="section-heading" value-text="contactHeading"></h2>
                        <h3 class="section-subheading text-muted">
                            <span class="fa fa-phone" value-text="contactPhone"> </span>
                        </h3>
                        <div class="text-center">
                            <label id="success"></label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div
                        class="col-xs-8 col-sm-8 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-2 col-md-offset-3 col-lg-offset-3">
                        <form id="contact-form" class="form" action="#" method="POST" role="form">
                            <div class="form-group">
                                <label class="form-label" for="name" value-text="contactName"></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nombre" tabindex="1" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email" value-text="contactEmail"></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" tabindex="2" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="phone" value-text="contactTelephone"></label>
                                <input type="tel" class="form-control" id="phone" name="phone" maxlength="9"
                                    placeholder="Telèfono" tabindex="3" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="message" value-text="contactMessage"></label>
                                <textarea rows="5" cols="50" name="message" class="form-control" id="message"
                                    placeholder="Mensaje..." tabindex="4" required></textarea>
                            </div>
                            <div>
                                <p class = 'clausulaContacto' value-text="contactoClausulaContacto"></p>
                                <p class = 'clausulaContacto' value-text="contactoClausulaContacto2"></p>
                            </div>
                            <div class="form-group text-center">
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
            </div>
        </section>
    </div>
    <script type="module" src="{{ asset('js/home.js') }}" defer></script>
@endsection
