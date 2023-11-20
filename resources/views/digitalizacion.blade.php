@extends('layouts.main')

@section('title', 'Digitalización')
@section('content')

    @include('components.navigationDigitalizacion')

    <body class="main">

        <section id="servicios" class="letter">
            <div>
                <h2 id="services-heading" class="titulos"></h2>
                <p id="services-text" class="letter"></p>
                <p id="services-letter" class="letter"></p>
                <img src="./imagenesdg/banner.jpg" class="img-responsive img-centered">
            </div>
        </section>
        <section id="agente" class="letter">
            <div>
                <h2 class="titulos">AGENTE DIGITALIZADOR</h2>

                <article class="letter"> Una empresa que ofrece soluciones y servicios tecnológicos que necesitan
                    las
                    pequeñas empresas para avanzar en la digitalización de sus negocios.</article>

                <img src="./imagenesdg/kitdigital.png" alt="kitdigital" class="kitdigital">
            </div>
        </section>
        <section>
            <div class="divbackground">
                <p class="preguntakitd">¿QUE ES EL KIT DIGITAL?</p>
                <p class="respuestakitd">El kit digital es una iniciativa del gobierno español, que tiene como
                    objetivo
                    subvencionar la implantación de soluciones digitales disponibles en el mercado para conseguir un
                    avance significativo en el nivel de madurez digital</p>
            </div>
        </section>
        <section>
            <div>
                <p class="titulos">¿A QUIÉN VA DIRIGIDO?</p>
                <p class="letter">Las soluciones digitales que proporciona el kit digital estan orientadas a las
                    necesidades de las pequeñas empresas, microempresas y trabajadores autonómos, que pertenezcan a
                    cualquier sector o tipología de negocio</p>
            </div>
        </section>
        <section>
            <div>
                <p class="titulos">¿CUÁL ES EL IMPORTE DEL BONO?</p>
                <p class="letter">Si cumples con las condiciones establecidas en las bases de la convocatoria de la
                    ayuda del KIT Digital, podrás disponer de un bono digital que te permitirá acceder a las
                    soluciones
                    de digitalización.</p>
                <p class="letter">Los bonos digitales oscilan entre 2.000 y 12.000 Euros en función del tamaño de tu
                    empresa.</p>
            </div>
        </section>
        <section id="requisitos">
            <div>
                <p class="titulos">REQUISITOS PARA SOLICITAR AYUDA</p>
                <ul>
                    <li>
                        <p class="letter">Ser una microempresa, pequeña empresa o trabajador autonómo. Tenga en
                            cuenta
                            que , en función del tamaño de su empresa, el bono del kit digital será de mayor o menor
                            cuantía</p>
                    </li>
                    <li>
                        <p class="letter">No estar sujeto a una orden de recuperación pendiente de la comisión
                            europea
                            que haya declarado una ayuda ilegal e incompatible con el mercado común</p>
                    </li>
                    <li>
                        <p class="letter">Estar en situación de alta y tener antigüedad mínima establecida en la
                            convocatoria</p>
                    </li>
                    <li>
                        <p class="letter">No tener la consideración de empresa en crisis</p>
                    </li>
                    <li>
                        <p class="letter">Estar al corriente de obligaciones tributarias con respecto a la seguridad
                            social</p>
                    </li>
                    <li>
                        <p class="letter">No incurrir en ninguna de las prohibiciones previstas en el articulo 13.2
                            de
                            la ley 38/2003, de 17 de noviembre, general de subvenciones</p>
                    </li>
                    <li>
                        <p class="letter">No superar el límite de ayudas mínimas</p>
                    </li>
                    <li>
                        <p class="letter">Hacer previamente el test de Autoevaluación del nivel de madurez digital
                            de
                            accelera PYME. Aunque el resultado no determinará su concesión</p>
                    </li>
                    <li>
                        <p class="letter">Iniciar el proyecto en los tres meses desde la concesión del kit digital
                        </p>
                    </li>
                </ul>
            </div>
        </section>
        <section>
            <div>
                <p class="titulos">DESDE PYMESOFT PODEMOS AYUDARTE CON:</p>
                <p class="frecuentes">Business Intelligence y Analítica</p>
                <p class="letter">Todas nuestras aplicaciones están conectadas al módulo de análisis de negocio de
                    SAGE
                    200c, a través del cual se puede extraer informes de análisis y reporting.</p>

                <p class="letter">Nuestro rango de precios oscila entre los 2000 y 6000 euros.</p>

                <p class="frecuentes">Gestión de clientes</p>
                <p class="letter">Nuestra solución BIIT Manager CRM permite una gestión integral de la relación con
                    los
                    clientes. La aplicación facilita el seguimiento comercial de forma ágil y eficaz.</p>

                <p class="letter">Nuestro rango de precios oscila entre los 4000 y 10000 euros.</p>

                <p class="frecuentes">Gestión de procesos</p>
                <p class="letter">En Pymesoft disponemos de diferentes herramientas para automatizar y digitalizar
                    los
                    principales procesos de gestión empresarial. Desde gestión de almacén, fabricación, intranet,
                    SAT o
                    laboral.</p>

                <p class="letter">Nuestro rango de precios oscila entre los 6000 y 30000 euros.</p>

                <p class="frecuentes">Factura electrónica</p>

                <p class="letter"> Todos nuestros módulos y soluciones envían información de facturación a SAGE
                    200c.
                    Este ERP permite despúes el envío de E-factura a los clientes.</p>
                <p class="letter">Nuestro rango de precios oscila entre los 1500 y 6000 euros.</p>

                <p class="frecuentes">Comercio Electrónico</p>
                <p class="letter">Ofrecemos el montaje y personalización de la tienda electrónica para cualquier
                    cliente
                    que lo requiera. Esta solución sirve para comercio B2B y B2C.</p>
                <p class="letter">Nuestro rango de precios oscila entre los 4000 y 8000 euros.</p>
            </div>
        </section>
        <section>
            <div>
                <p class="titulos" id="bono digital">SOLICITAR BONO DIGITAL</p>
                <ul>
                    <li>
                        <p class="letter">Regístrate en: <a
                                href="https://www.acelerapyme.es/user/login">https://www.acelerapyme.gob.es/</a> y
                            completa el <a
                                href="https://acelerapyme.es/quieres-conocer-el-grado-de-digitalizacion-de-tu-pyme">
                                Test de diagnóstico</a></p>
                    </li>
                    <li>
                        <p class="letter">Consulta la información disponible de las <a
                                href="https://acelerapyme.es/kit-digital/soluciones-digitales">soluciones de
                                digitalización</a> que pondrá a tu disposición el programa kit digital</p>
                    </li>
                    <li>
                        <p class="letter">Solicita la ayuda kit digital en la sede electrónica de <a
                                href="https://sede.red.gob.es/"> Red.es</a> y completa todos los formularios </p>
                    </li>
                </ul>
            </div>
        </section>
        <section>
            <div id="faq">
                <p class="titulos"> PREGUNTAS FRECUENTES</p>
            </div>
            <div>
                <div>
                    <p class="frecuentes">¿Puedo pedir un bono digital para mejorar un servicio que ya tengo?</p>
                    <p class="letter">Sí, siempre y cuando la nueva solución suponga una mejora funcional con
                        respecto a
                        la que tienes actualmente y, por tanto, la sustituya. Por ejemplo, puedes destinar el bono
                        digital a renovar tu página web actual o a mejorar tu sistema de copias de seguridad cloud
                        por
                        uno con doble copia y mayores prestaciones de seguridad</p>
                </div>

                <div>
                    <p class="frecuentes">¿Cómo y cuándo se cobran las ayudas?</p>
                    <p class="letter">Las ayudas se cobrarán en forma de bono digital, y no podrán hacerse efectivos
                        hasta que el agente digitalizador, en nombre de la empresa beneficiaria,justifique la
                        realización de la actividad por la cual se concede la subvención y el órgano regulador
                        considere
                        aprobada su concesión.
                        Para ello, la empresa beneficiaria debería firmar un acuerdo de Prestación de soluciones de
                        Digitalización con alguno de los agntes digitalizadores adheridos a su seleccionado
                    </p>
                </div>

                <div>
                    <p class="frecuentes">Quiero obtener mi kit digital</p>
                    <p class="letter">Ponte en contacto con nosotros y te informaremos: <a href="/#contact">
                            Contacto</a>
                    </p>
                </div>
            </div>
        </section>

        <img src="./imagenesdg/kit-digital.png" class="img-responsive img-centered">

    </body>

    <script type="module" src="{{ asset('js/digitalizacion.js') }}"></script>
@endsection
