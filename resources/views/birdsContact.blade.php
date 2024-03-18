@extends('layouts.main')

@section('title', 'Birds Contact')
@section('content')

    @include('components.navigationHome')

    <main class="birdsContact">
        <!-- Birds Contact Section -->
        <section id="logo" class="row">
            <article class="box__logo">
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <img src="{{ asset('../img/logos/pymesoft_logo_text.png') }}" alt="">
                    </a>
                </span>
                <span class="box__logo__image">
                    <a href="{{ route('home', ['language' => $language]) }}">
                        <img src="{{ asset('img/logos/logo_biit.png') }}" alt="">
                    </a>
                </span>
            </article>
        </section>
        <section id="contact" class="row">
            <article class="box">
                <h2 class="box__title" value-text="formTitulo"></h2>
            </article>
            <article class="form">
                <form action="{{ route('birdsContact.submit') }}" method="POST" enctype="multipart/form-data"
                    id="contactForm">
                    @csrf
                    <div class="form__group">
                        <label class="form__group__content" for="name" value-text="formNombre"></label>
                        <input class="form__group__input" type="text" id="name" name="name" placeholder="Name"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="form__group">
                        <label class="form__group__content" for="email" value-text="formCorreo"></label>
                        <input class="form__group__input" type="email" id="correo" name="email" placeholder="Email"
                            value="{{ old('email') }}" required>
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
                        <div class="form__group__consent">
                            <input class="form__group__consent__check" type="checkbox" id="aceptarTerminos"
                                name="aceptarTerminos" required>
                            <label class="form__group__consent__content" for="aceptarTerminos"
                                value-text="formAceptarTerminos"></label>
                        </div>
                    </div>
                    <div class="form__group">
                        <button class="form__group__button" type="submit" value-text="formEnviar"></button>
                    </div>
                </form>
            </article>
        </section>
    </main>
    <script type="module" src="{{ asset('js/birdsContact.js') }}" defer></script>
@endsection
