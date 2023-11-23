@extends('layouts.main')

@section('title', 'Biit')
@section('content')

    @include('components.navigationHome')

    <body class="main">

        <!-- Header -->
        <header>
            <div class="container">
                <div class="intro-text">
                    <div value-text="biitHeader" class="intro-heading"></div>
                    <a value-text="biitSubheader" href="{{ route('biit') }}" class="page-scroll btn btn-xl"></a>
                    {{-- #services2 --}}
                </div>
            </div>
        </header>

        <!-- Services Section -->
        <section id="services2">
            <div>
                <h3 value-text="biitHeading" class="section-heading"> </h3>
                <p value-text="biitSubeading" class="text-muted text-justify"></p>
            </div>
            <div>
                <div>
                    <div>
                        <p>Image</p>
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
                        <p>Image2</p>
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
                        <p>Image3</p>
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

    </body>
    <script type="module" src="{{ asset('js/biit.js') }}"></script>
@endsection
