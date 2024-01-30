@extends('layouts.main')

@section('title', 'whyBiit')
@section('content')

    @include('components.navigationBiit')

    <div class="main">
        <section class="biit">
            <div class="biit__row--content" id="mainContainer">
                <div class="first circle" id="firstModal" data-modal-id="firstModal">
                    <h4 class="circle__title" value-text="modulosCliente"></h4>
                </div>
                <div class="second circle" id="secondModal" data-modal-id="secondModal">
                    <h4 class="circle__title" value-text="modulosComercio"></h4>
                </div>
                <div class="third circle" id="thirdModal" data-modal-id="thirdModal">
                    <h4 class="circle__title" value-text="modulosProcesos"></h4>
                </div>
                <div class="fourth circle" id="fourthModal" data-modal-id="fourthModal">
                    <h4 class="circle__title" value-text="modulosFactura"></h4>
                </div>
                <div class="fifth circle" id="fifthModal" data-modal-id="fifthModal">
                    <h4 class="circle__title" value-text="modulosBusiness"></h4>
                </div>
            </div>
        </section>
        <!-- Biit Section -->
        <section>
            <div id="biit">
                <h3 value-text="biitHeading" class="section-heading"> </h3>
                <p value-text="biitSubeading" class="text-muted text-justify"></p>
            </div>
            <div>
                <div>
                    <div>
                        <!-- <p>image</p> -->
                    </div>
                    <div>
                        <div>
                            <h3 value-text="biitPersonalizacion" class="section-heading"> </h3>
                        </div>
                        <div>
                            <p value-text="biitPersonalizacionText" class="text-muted text-justify"></p>
                        </div>
                    </div>
                </div>

                <div>
                    <div>
                        <!-- <p>image</p> -->
                    </div>
                    <div>
                        <div>
                            <h3 value-text="biitExperiencia" class="section-heading"> </h3>
                        </div>
                        <div>
                            <p value-text="biitExperienciaText" class="text-muted text-justify"></p>
                        </div>
                    </div>
                </div>

                <div>
                    <div>
                        <!-- <p>image</p> -->
                    </div>
                    <div>
                        <div>
                            <h3 value-text="biitOnline" class="section-heading"> </h3>
                        </div>
                        <div>
                            <p value-text="biitOnlineText" class="text-muted text-justify"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br><br><br><br><br><br><br><br>
        <!-- Modulos Section -->
        <section id="porque">
            <div>
                <h3 value-text="modulosHeader" class="section-heading"> </h3>
            </div>
            <div>
                <div>
                    <div>
                        <div>
                            <!-- <p>image</p> -->
                        </div>
                        <div>
                            <h3 value-text="modulosCliente" class="section-heading"> </h3>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p value-text="modulosClienteText" class="text-muted text-justify"></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <div>
                            <!-- <p>image</p> -->
                        </div>
                        <div>
                            <h3 value-text="modulosComercio" class="section-heading"> </h3>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p value-text="modulosComercioText" class="text-muted text-justify"></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <div>
                            <!-- <p>image</p> -->
                        </div>
                        <div>
                            <h3 value-text="modulosProcesos" class="section-heading"> </h3>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p value-text="modulosProcesosText" class="text-muted text-justify"></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <div>
                            <!-- <p>image</p> -->
                        </div>
                        <div>
                            <h3 value-text="modulosBusiness" class="section-heading"> </h3>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p value-text="modulosBusinessText" class="text-muted text-justify"></p>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <div>
                            <!-- <p>image</p> -->
                        </div>
                        <div>
                            <h3 value-text="modulosFactura" class="section-heading"> </h3>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p value-text="modulosFacturaText" class="text-muted text-justify"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script type="module" src="{{ asset('js/whyBiit.js') }}" defer></script>
@endsection
