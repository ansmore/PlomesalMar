@extends('layouts.main')

@section('title', 'Digitalización')
@section('content')

    @include('components.navigationDigitalizacion')

    <body class="main">

        <section id="servicios" class="letter">
            <div>
                <h2 value-text="servicesHeading" class="titulos"></h2>
                <p value-text="servicesText" class="letter"></p>
                <p value-text="servicesLetter" class="letter"></p>
                <img src="./img/banner.jpg" class="img-responsive img-centered">
            </div>
        </section>
        <section id="agente" class="letter">
            <div>
                <h2 value-text="agenteTitle" class="titulos"></h2>

                <article value-text="agenteLetter" class="letter"></article>

                <img src="./img/kitdigital.png" alt="kitdigital" class="kitdigital">
            </div>
        </section>
        <section>
            <div class="divbackground">
                <p value-text="kitPregunta" class="preguntakitd"></p>
                <p value-text="kidRespuesta" class="respuestakitd"></p>
            </div>
        </section>
        <section>
            <div>
                <p value-text="kitDirecction" class="titulos"></p>
                <p value-text="kitSoluciones" class="letter"></p>
            </div>
        </section>
        <section>
            <div>
                <p value-text="bonoHeading" class="titulos"></p>
                <p value-text="bonoCondiciones" class="letter"></p>
                <p value-text="bonoCantidad" class="letter"></p>
            </div>
        </section>
        <section id="requisitos">
            <div>
                <p value-text="requisitosHeading" class="titulos"></p>
                <ul>
                    <li>
                        <p value-text="requisitosMicroempresa" class="letter"></p>
                    </li>
                    <li>
                        <p value-text="requisitosRecuperacion" class="letter"></p>
                    </li>
                    <li>
                        <p value-text="requisitosSituacion" class="letter"></p>
                    </li>
                    <li>
                        <p value-text="requisitosCrisis" class="letter"></p>
                    </li>
                    <li>
                        <p value-text="requisitosObligaciones" class="letter"></p>
                    </li>
                    <li>
                        <p value-text="requisitosProhibiciones" class="letter"></p>
                    </li>
                    <li>
                        <p value-text="requisitosLimite" class="letter"></p>
                    </li>
                    <li>
                        <p value-text="requisitosAutoevaluacion" class="letter"></p>
                    </li>
                    <li>
                        <p value-text="requisitosIniciar" class="letter"></p>
                    </li>
                </ul>
            </div>
        </section>
        <section>
            <div>
                <p value-text="ayudaHeading" class="titulos"></p>
                <p value-text="ayudaBusines" class="frecuentes"></p>
                <p value-text="ayudaAnalisis" class="letter"></p>
                <p value-text="ayudaRango" class="letter"></p>
                <p value-text="ayudaClientes" class="frecuentes"></p>
                <p value-text="ayudaBIIT" class="letter"></p>
                <p value-text="ayudaPrecios" class="letter"></p>
                <p value-text="ayudaGestion" class="frecuentes"></p>
                <p value-text="ayudaHerramientas" class="letter"></p>
                <p value-text="ayudaNuestro" class="letter"></p>
                <p value-text="ayudaFactura" class="frecuentes"></p>
                <p value-text="ayudaModulos" class="letter"></p>
                <p value-text="ayudaModulosSage" class="letter"></p>
                <p value-text="ayudaComercio" class="frecuentes"></p>
                <p value-text="ayudaComercioElectronico" class="letter"></p>
                <p value-text="ayudaComercioPrecios" class="letter"></p>
            </div>
        </section>
        <section>
            <div>
                <p value-text="solicitarHeading" class="titulos" id="bono digital"></p>
                <ul>
                    <li>
                        <p value-text="solicitarRegistro" class="letter"> </p>
                        <a value-text="solicitarWeb" href="https://www.acelerapyme.es/user/login"></a>
                        <p value-text="solicitarCompleta"></p>
                        <a value-text="solicitarTest"
                            href="https://acelerapyme.es/quieres-conocer-el-grado-de-digitalizacion-de-tu-pyme"></a>

                    </li>
                    <li>
                        <p value-text="solicitarConsulta" class="letter"> </p>
                        <a value-text="solicitarSoluciones"
                            href="https://acelerapyme.es/kit-digital/soluciones-digitales"></a>
                        <p value-text="solicitarKitDigital"></p>

                    </li>
                    <li>
                        <p value-text="solicitarSedeElectronica" class="letter"></p>
                        <a value-text="solicitarRed" href="https://sede.red.gob.es/"></a>
                        <p value-text="solicitarFormularios"></p>

                    </li>
                </ul>
            </div>
        </section>
        <section>
            <div id="faq">
                <p value-text="faqPreguntas" class="titulos"></p>
            </div>
            <div>
                <div>
                    <p value-text="faqBono" class="frecuentes"></p>
                    <p value-text="faqSolucion" class="letter"></p>
                </div>
                <div>
                    <p value-text="faqCobrar" class="frecuentes"></p>
                    <p value-text="faqAyudas" class="letter"></p>
                </div>
                <div>
                    <p value-text="faqObtener" class="frecuentes"></p>
                    <p value-text="faqContacto" class="letter">
                        <a value-text="faqContactUs" href="/#contact"></a>
                    </p>
                </div>
            </div>
        </section>

        <img src="./img/kit-digital.png" class="img-responsive img-centered">
    </body>
    <script type="module" src="{{ asset('js/digitalizacion.js') }}"></script>
@endsection
