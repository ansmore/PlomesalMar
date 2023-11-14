@extends('layouts.main')

@section('title', 'Inicio')
@section('content')

    <body class="main">
        <!-- Services Section -->
        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading" id="home-services"></h2>
                        <h3 class="section-subheading text-muted" id="home-services-subheading"></h3>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-check-square-o  fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading">
                            <a href="https://biit.es">Implementaci&oacute;n de soluciones multiplataforma ( BIIT )</a>
                        </h4>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-users fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading">Outsourcing</h4>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-list-ul cart fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading">
                            <a href="consultoria.html">Consultor&iacute;a y desarrollo de soluciones entorno SAGE</a>
                        </h4>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-6">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle  fa-stack-2x text-primary"></span>
                            <span class="fa fa-shopping-cart fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading">
                            <a href="https://biit.es/">Integraci&oacute;n de soluciones hacia el ERP SAGE MURANO</a>
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-briefcase fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading">
                            <a href="https://biit.es/">Soluciones E-Commerce, SAT, SGA, Captura de datos de Planta, CRM ...
                                Multiplataforma</a>
                        </h4>
                    </div>
                </div>
            </div>
        </section>

    </body>

    <script type="module" src="{{ asset('js/home.js') }}"></script>
@endsection
