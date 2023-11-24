@extends('layouts.main')

@section('title', 'Biit')
@section('content')

    @include('components.navigationBiit')

    <body class="main">


        <!-- Biit Modulos Section -->
        <section>
            <div id="gestion">
                <div>
                    <h3 value-text="gestionHeading" class="section-heading"> </h3>
                    <p value-text="gestionSubeading" class="text-muted text-justify"></p>
                </div>
                <div>
                    <img src="img/biit/gestion.png" class="img-responsive img-centered" alt="banner">
                </div>
            </div>
        </section>
        <br><br><br>
        <section>
            <div id="comercio">
                <div>
                    <h3 value-text="comercioHeading" class="section-heading"> </h3>
                    <p value-text="comercioSubeading" class="text-muted text-justify"></p>
                </div>
                <div>
                    <img src="img/biit/ecommerce.png" class="img-responsive img-centered" alt="banner">
                </div>
            </div>
        </section>
        <br><br><br>
        <section>
            <div id="proceso">
                <div>
                    <h3 value-text="procesosHeading" class="section-heading"> </h3>
                    <p value-text="procesosSubeading" class="text-muted text-justify"></p>
                </div>
                <div>
                    <img src="img/biit/procesos.png" class="img-responsive img-centered" alt="banner">
                </div>
            </div>
        </section>
        <br><br><br>
        <section>
            <div id="busines">
                <div>
                    <h3 value-text="businessHeading" class="section-heading"> </h3>
                    <p value-text="businessSubeading" class="text-muted text-justify"></p>
                </div>
                <div>
                    <img src="img/biit/gestion.png" class="img-responsive img-centered" alt="banner">
                </div>
            </div>
        </section>
        <br><br><br>
        <section>
            <div id="factura">
                <div>
                    <h3 value-text="facturaHeading" class="section-heading"> </h3>
                    <p value-text="facturaSubeading" class="text-muted text-justify"></p>
                </div>
                <div>
                    <img src="img/biit/facturacion.png" class="img-responsive img-centered" alt="banner">
                </div>
            </div>
        </section>
        <br><br><br><br><br><br><br><br>
    </body>
    @include('components.footerBiit')
    <script type="module" src="{{ asset('js/biitModules.js') }}"></script>
@endsection
