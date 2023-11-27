@extends('layouts.main')

@section('title', 'Biit')
@section('content')

    @include('components.navigationBiit')

    <div class="main">


        <!-- Biit Contact Section -->
        <section>
            <h2 value-text="formTitulo"></h2>

            <form id="contactForm" action="{{ route('biitContact') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="nombre" value-text="formNombre"></label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="correo" value-text="formCorreo"></label>
                    <input type="email" id="correo" name="correo" required>
                </div>

                <div class="form-group">
                    <label for="asunto" value-text="formAsunto"></label>
                    <input type="text" id="asunto" name="asunto" required>
                </div>

                <div class="form-group">
                    <label for="mensaje" value-text="formMensaje"></label>
                    <textarea id="mensaje" name="mensaje" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="aceptarTerminos" name="aceptarTerminos" required>
                    <label for="aceptarTerminos" value-text="formAceptarTerminos"></label>
                </div>

                <button type="submit" value-text="formEnviar"></button>
            </form>
        </section>
        <br><br><br><br><br><br><br><br>
    </div>

    <script type="module" src="{{ asset('js/biitContact.js') }}" defer></script>
@endsection
