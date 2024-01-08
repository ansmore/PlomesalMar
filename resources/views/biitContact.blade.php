@extends('layouts.main')

@section('title', 'Biit')
@section('content')

    @include('components.navigationBiit')

    <div class="main">
        <!-- Biit Contact Section -->
        <section id="contact" class="contact">
            <div class="contact__row">
                <div class="circle">
                    <span class="circle__image">
                        <img src="{{ asset('img/logos/pymesoft_logo_image.png') }}" alt="">
                    </span>
                    <span class="circle__image">
                        <img src="{{ asset('img/logos/logo_biit.png') }}" alt="">
                    </span>
                </div>
            </div>
            <div class="contact__row">
                <div class="box">
                    <h2 class="box__title" value-text="formTitulo"></h2>
                </div>
                <div class="form">
                    <form id="contactForm" action="{{ route('biitContact') }}" method="post">
                        @csrf
                        <div class="form__group">
                            <label class="form__group__content" for="nombre" value-text="formNombre"></label>
                            <input class="form__group__input" type="text" id="nombre" name="nombre" required>
                        </div>
                        <div class="form__group">
                            <label class="form__group__content" for="correo" value-text="formCorreo"></label>
                            <input class="form__group__input" type="email" id="correo" name="correo" required>
                        </div>
                        <div class="form__group">
                            <label class="form__group__content" for="asunto" value-text="formAsunto"></label>
                            <input class="form__group__input" type="text" id="asunto" name="asunto" required>
                        </div>
                        <div class="form__group">
                            <label class="form__group__content" for="mensaje" value-text="formMensaje"></label>
                            <textarea class="form__group__input" id="mensaje" name="mensaje" rows="4" required></textarea>
                        </div>
                        <div class="form__group--consent">
                            <input class="form__group--consent__check" type="checkbox" id="aceptarTerminos"
                                name="aceptarTerminos" required>
                            <label class="form__group--consent__consent" for="aceptarTerminos"
                                value-text="formAceptarTerminos"></label>
                        </div>
                        <div class="form__group">
                            <button class="form__group__button type="submit" value-text="formEnviar"></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script type="module" src="{{ asset('js/biitContact.js') }}" defer></script>
@endsection
