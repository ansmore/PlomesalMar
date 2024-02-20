@extends('layouts.main')

@section('title', 'Digitalización')
@section('content')

    @include('components.navigationDigitalization')
    {{-- @include('components.header') --}}

    <div class="main">

        <section id="whatIs" class="whatIs">
            <div class="whatIs__row">
                <div class="box">
                    <h2 value-text="servicesHeading" class="box__subtitle"></h2>
                    <p value-text="servicesText" class="box__content"></p>
                    {{-- Contenido eliminado  --}}
                    {{-- <p value-text="servicesLetter" class="box__content"></p> --}}
                    {{-- <img src="{{ asset('./img/banner.jpg') }}" class="box__image"> --}}
                </div>
            </div>
        </section>
        <section id="about" class="about">
            <div class="about__row">
                <div class="box">
                    <p value-text="kitPregunta" class="box__title"></p>
                </div>
                <div class="box">
                    <div class="box__columns">
                        <div class="box__columns__col">
                            <div class="box__columns__col__item">
                                <p value-text="kidRespuestaA" class="box__content"></p>
                            </div>
                            <div class="box__columns__col__item">
                                <p value-text="kidRespuestaB" class="box__content"></p>
                            </div>
                        </div>
                        <div class="box__columns__col">
                            <div class="box__columns__col__item">
                                <p value-text="kidRespuestaC" class="box__content"></p>
                            </div>
                            <div class="box__columns__col__item">
                                <p value-text="kidRespuestaD" class="box__content"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="agent" class="whatIs">
            <div class="whatIs__row">
                <div class="box">
                    <h2 value-text="agenteTitle" class="box__subtitle"></h2>
                    <article class="box__content">
                        <span value-text="agenteLetterA" class="box__content"></span>
                        <span value-text="businessName" class="box__name"></span>
                        <span value-text="agenteLetterB" class="box__content"></span>
                    </article>
                    <img src="{{ asset('./img/kitdigital.png') }}" alt="kitdigital" class="box__image">
                </div>
            </div>
        </section>
        <section class="whatIs">
            <div class="whatIs__row">
                <div class="box">
                    <p value-text="kitDirecction" class="box__subtitle"></p>
                    <p value-text="kitSoluciones" class="box__content"></p>
                </div>
            </div>
        </section>

        <section id="requirements" class="whatIs">
            <div class="whatIs__row">
                <div class="box">
                    <p value-text="requisitosHeading" class="box__subtitle"></p>
                    <ul>
                        <li>
                            <p value-text="requisitosMicroempresa" class="box__content"></p>
                        </li>
                        <li>
                            <p value-text="requisitosRecuperacion" class="box__content"></p>
                        </li>
                        <li>
                            <p value-text="requisitosSituacion" class="box__content"></p>
                        </li>
                        <li>
                            <p value-text="requisitosCrisis" class="box__content"></p>
                        </li>
                        <li>
                            <p value-text="requisitosObligaciones" class="box__content"></p>
                        </li>
                        <li>
                            <p value-text="requisitosProhibiciones" class="box__content"></p>
                        </li>
                        <li>
                            <p value-text="requisitosLimite" class="box__content"></p>
                        </li>
                        <li>
                            <p value-text="requisitosAutoevaluacion" class="box__content"></p>
                        </li>
                        <li>
                            <p value-text="requisitosIniciar" class="box__content"></p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <section class="whatIs">
            <div class="whatIs__row">
                <div class="box">
                    <p value-text="bonoHeading" class="box__subtitle"></p>
                    <article>
                        <span value-text="bonoCondiciones" class="box__content"></span>
                        <span value-text="bonoCantidad" class="box__content"></span>
                    </article>
                </div>
            </div>
        </section>
        <section id="bond" class="whatIs">
            <div class="whatIs__row">
                <div class="box">
                    <p value-text="solicitarHeading" class="box__subtitle"></p>
                    <p>
                        <span value-text="solicitarRegistro" class="box__content"></span>
                        <a class="box__name" value-text="solicitarWeb" href="https://www.acelerapyme.es/user/login"></a>
                        <span value-text="solicitarCompleta"></span>
                        <a class="box__name" value-text="solicitarTest"
                            href="https://acelerapyme.es/quieres-conocer-el-grado-de-digitalization-de-tu-pyme"></a>

                    </p>
                    <p>
                        <span value-text="solicitarConsulta" class="box__content"> </span>
                        <a class="box__name" value-text="solicitarSoluciones"
                            href="https://acelerapyme.es/kit-digital/soluciones-digitales"></a>
                        <span value-text="solicitarKitDigital"></span>

                    </p>
                    <p>
                        <span value-text="solicitarSedeElectronica" class="box__content"></span>
                        <a class="box__name" value-text="solicitarRed" href="https://sede.red.gob.es/"></a>
                        <span value-text="solicitarFormularios"></span>

                    </p>
                </div>
            </div>
        </section>
        <section class="whatIs">
            <div class="whatIs__row">
                <div class="box">
                    <p value-text="ayudaHeading" class="box__subtitle"></p>
                    <p value-text="ayudaBusines" class="box__subtitle__secondary"></p>
                    <p value-text="ayudaAnalisis" class="box__content"></p>
                    <p value-text="ayudaRango" class="box__content"></p>
                    <p value-text="ayudaClientes" class="box__subtitle__secondary"></p>
                    <p value-text="ayudaBIIT" class="box__content"></p>
                    <p value-text="ayudaPrecios" class="box__content"></p>
                    <p value-text="ayudaGestion" class="box__subtitle__secondary"></p>
                    <p value-text="ayudaHerramientas" class="box__content"></p>
                    <p value-text="ayudaNuestro" class="box__content"></p>
                    <p value-text="ayudaFactura" class="box__subtitle__secondary"></p>
                    <p value-text="ayudaModulos" class="box__content"></p>
                    <p value-text="ayudaModulosSage" class="box__content"></p>
                    <p value-text="ayudaComercio" class="box__subtitle__secondary"></p>
                    <p value-text="ayudaComercioElectronico" class="box__content"></p>
                    <p value-text="ayudaComercioPrecios" class="box__content"></p>
                </div>
            </div>
        </section>

        <section id="faq" class="whatIs">
            <div class="whatIs__row">
                <div class="box">
                    <p value-text="faqPreguntas" class="box__subtitle"></p>
                </div>
                <div class="box">
                    <div>
                        <p value-text="faqBono" class="box__subtitle__secondary"></p>
                        <p value-text="faqSolucion" class="box__content"></p>
                    </div>
                    <div>
                        <p value-text="faqCobrar" class="box__subtitle__secondary"></p>
                        <p value-text="faqAyudas" class="box__content"></p>
                    </div>
                    <div>
                        <p value-text="faqObtener" class="box__subtitle__secondary"></p>
                        <p value-text="faqContacto" class="box__content">
                            <a value-text="faqContactUs" href="/#contact"></a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <img src="{{ asset('./img/kit-digital.png') }}" class="img-responsive img-centered">
    </div>
    <script type="module" src="{{ asset('js/digitalization.js') }}" defer></script>
@endsection
