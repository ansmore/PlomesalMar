@extends('layouts.main')

@section('title', 'Consultoria')
@section('content')

    @include('components.navigationHome')

    <body class="main">

        <!-- Header -->
        <header>
            <div class="container">
                <div class="intro-text">
                    <div value-text="consultoriaHeader" class="intro-heading"></div>
                    <a value-text="consultoriaInformacion" href="#services2" class="page-scroll btn btn-xl"></a>
                </div>
            </div>
        </header>

        <!-- Services Section -->
        <section id="services2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-center" <span class="fa-stack fa-4x">
                        <span class="fa fa-circle fa-stack-2x text-primary"></span>
                        <span class="fa fa-list-ul cart fa-stack-1x fa-inverse"></span>
                        </span>
                        <h3 value-text="consultoriaServicio" class="section-heading"> </h3>
                        <p value-text="consultoriaInformaticos" class="text-muted text-justify"></p>
                        <p value-text="consultoriaPymesoft" class="text-muted text-justify"></p>
                    </div>
                    <div class="col-lg-6 text-center">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-list-ul cart fa-stack-1x fa-inverse"></span>
                        </span>
                        <h3 value-text="consultoriaServicioMantenimiento" class="section-heading"></h3>
                        <p value-text="consultoriaIntegrado" class="text-muted text-justify"></p>
                        <p value-text="consultoriaMantenimiento" class="text-muted text-justify"></p>
                    </div>

                    <div class="col-lg-6 text-center  col-md-offset-0 col-lg-offset-3">

                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-list-ul cart fa-stack-1x fa-inverse"></span>
                        </span>
                        <h3 value-text="consultoriaTelematicos" class="section-heading"></h3>
                        <p value-text="consultoriaServiciosEmpresa" class="text-muted text-justify"></p>
                    </div>
                    <div class="col-lg-6 text-center">
                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-list-ul cart fa-stack-1x fa-inverse"></span>
                        </span>
                        <h3 value-text="consultoriaSoftware" class="section-heading"></h3>
                        <p value-text="consultoriaGamaSage" class="text-muted text-justify"></p>
                        <p value-text="consultoriaMurano" class="text-muted text-justify"></p>
                        <p value-text="consultoriaNecesidades" class="text-muted text-justify"></p>
                        <p value-text="consultoriaAplicaciones" class="text-muted text-justify"></p>
                    </div>

                    <div class="col-lg-6 text-center">

                        <span class="fa-stack fa-4x">
                            <span class="fa fa-circle fa-stack-2x text-primary"></span>
                            <span class="fa fa-list-ul cart fa-stack-1x fa-inverse"></span>
                        </span>

                        <h3 class="section-heading">Formación</h3>
                        <p class="text-muted text-justify">La formación continua es una condición necesaria para obtener
                            siempre el rendimiento adecuado de las herramientas y los equipos informáticos disponibles.
                            Pymesoft informáticos le garantiza el máximo aprovechamiento de su tiempo, mediante el uso de
                            las últimas tecnologías, la experiencia y el trato personalizado de nuestros profesores.</p>

                        <p class="text-muted text-justify">Disponemos de diferentes aulas preparadas para impartir cursos de
                            ofimática, gestión administrativa y comercial, fiscal y laboral, sistemas operativos y entornos,
                            nuevas tecnologías en comunicaciones … con un enfoque práctico de los temarios, por parte de
                            nuestros profesores.</p>
                    </div>
                </div>
            </div>
        </section>


    </body>
    <script type="module" src="{{ asset('js/digitalizacion.js') }}"></script>
@endsection
