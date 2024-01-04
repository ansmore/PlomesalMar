@extends('layouts.main')

@section('title', 'Biit')
@section('content')

    @include('components.navigationBiit')

    <div class="main">

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
    <script type="module" src="{{ asset('js/biit.js') }}" defer></script>
@endsection
