@extends('layouts.main')

@section('title', 'Inicio')
@section('content')

    <body class="main">
        <!-- Services Section -->
        <section id="services">
            <div class="container-services">
                <div class="row">
                    <div>
                        <h2 class="section-heading" id="home-services"></h2>
                        <h3 class="section-subheading text-muted" id="home-services-subheading"></h3>
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
                            <a href="https://biit.es" id="services-1"></a>
                        </h4>
                    </div>
                    <div class="row-1-service">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-users fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading" id="services-2"></h4>
                    </div>
                    <div class="row-1-service">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-list-ul cart fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading">
                            <a href="consultoria.html" id="services-3"></a>
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
                            <a href="https://biit.es/" id="services-4"></a>
                        </h4>
                    </div>
                    <div class="row-2-service">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-briefcase fa-stack-1x fa-inverse"></span>
                        </span>
                        <h4 class="service-heading">
                            <a href="https://biit.es/" id="services-5"></a>
                        </h4>
                    </div>
                </div>
            </div>
        </section>

    </body>

    <script type="module" src="{{ asset('js/home.js') }}"></script>
@endsection
