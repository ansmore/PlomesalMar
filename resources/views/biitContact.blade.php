@extends('layouts.main')

@section('title', 'Biit Contact')
@section('content')

    @include('components.navigationBiit')

    <div class="main">
        <!-- Biit Contact Section -->
        <section id="contact" class="contact">
            <div class="contact__row">
                <div class="circles">
                    <span class="circles__pyme">
                        <a href="{{ route('home', ['language' => $language]) }}">
                            <img src="{{ asset('../img/logos/pymesoft_logo_text.png') }}" alt="">
                        </a>
                    </span>
                    <span class="circles__biit">
                        <a href="{{ route('biit', ['language' => $language]) }}">
                            <img src="{{ asset('img/logos/logo_biit.png') }}" alt="">
                        </a>
                    </span>
                </div>
            </div>
            <div class="contact__row">
                <div class="box">
                    <h2 class="box__title" value-text="formTitulo"></h2>
                </div>
                <div class="form">
                    <form action="{{ route('biitContact.submit') }}" method="POST" enctype="multipart/form-data"
                        id="contactForm">
                        @csrf
                        <div class="form__group">
                            <label class="form__group__content" for="name" value-text="formNombre"></label>
                            <input class="form__group__input" type="text" id="name" name="name"
                                placeholder="Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form__group">
                            <label class="form__group__content" for="email" value-text="formCorreo"></label>
                            <input class="form__group__input" type="email" id="correo" name="email"
                                placeholder="Email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form__group">
                            <label class="form__group__content" for="mailsubject" value-text="formAsunto"></label>
                            <input class="form__group__input" type="text" id="asunto" name="mailsubject"
                                placeholder="Subject" value="{{ old('mailsubject') }}" required>
                        </div>
                        <div class="form__group">
                            <label class="form__group__content" for="message" value-text="formMensaje"></label>
                            <input class="form__group__input" id="mensaje" name="message" rows="4"
                                placeholder="Mail subject" value="{{ old('message') }}" required></input>
                        </div>
                        <div class="form__group">
                            <div class="form__group--consent">
                                <input class="form__group--consent__check" type="checkbox" id="aceptarTerminos"
                                    name="aceptarTerminos" required>
                                <label class="form__group--consent__consent" for="aceptarTerminos"
                                    value-text="formAceptarTerminos"></label>
                            </div>
                        </div>
                        <div class="form__group">
                            <button class="form__group__button" type="submit" value-text="formEnviar"></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script type="module" src="{{ asset('js/biitContact.js') }}" defer></script>
@endsection
