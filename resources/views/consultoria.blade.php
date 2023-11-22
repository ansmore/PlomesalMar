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
                    <a value-text="consultoriaInformacion"
                        href="{{ route('consultoria.section', ['section' => 'services2']) }}"
                        class="page-scroll btn btn-xl"></a>
                    {{-- #services2 --}}
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

                        <h3 value-text="consultoriaFormacion" class="section-heading"></h3>
                        <p value-text="consultoriaFormaconText" class="text-muted text-justify"></p>

                        <p value-text="consultoriaAulas" class="text-muted text-justify"></p>
                    </div>
                </div>
            </div>
        </section>


    </body>
    <script type="module" src="{{ asset('js/digitalizacion.js') }}"></script>
@endsection
