@extends('layouts.auth')

@section('title', 'Register')
@section('content')

    <main class="auth">
        <section id="contact" class="row">
            <article class="form">
                <span class="box__title">{{ __('Register') }}</span>
                <form method="POST" action="{{ route('register', ['language' => $language]) }}" id="registerForm">
                    @csrf

                    <div class="form__group">
                        <label for="name" class="form__group__content">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form__group__input @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form__group">
                        <label for="email" class="form__group__content">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form__group__input @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form__group">
                        <label for="password" class="form__group__content">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form__group__input  @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form__group">
                        <label for="password-confirm" class="form__group__content">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form__group__input" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                    <div class="form__group">
                        <button type="submit" class="form__group__button">
                            {{ __('Register') }}
                        </button>
                    </div>
                    <div class="form__group">
                        @if (Route::has('login'))
                            <a class="form__group__content"
                                href="{{ route('login', ['language' => $language]) }}">{{ __('Login') }}</a>
                        @endif
                    </div>
                </form>
            </article>
        </section>
    </main>
@endsection
