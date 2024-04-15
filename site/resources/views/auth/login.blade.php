@extends('layouts.main')

@section('title', 'Login')
@section('content')

    @include('components.navigationHome')
    <main class="loginRegister">
        <section id="contact" class="row">
            <article class="box">
                <div class="box__title">{{ __('Login') }}</div>
            </article>
            <article class="form">
                <form action="{{ route('login', ['language' => $language]) }}" method="POST" id="loginForm">
                    @csrf

                    <div class="form__group">
                        <label for="email" class="form__group__content">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form__group__input @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form__group">
                        <label for="password" class="form__group__content">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form__group__input @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form__group">
                        <div class="form__group__consent">
                            <input class="form__group__consent__check" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form__group__consent__content" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="form__group">
                        <button type="submit" class="form__group__button">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <div class="form__group">
                        @if (Route::has('password.request'))
                            <a class="form__group__content"
                                href="{{ route('password.request', ['language' => $language]) }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a class="form__group__content"
                                href="{{ route('register', ['language' => $language]) }}">{{ __('Register') }}</a>
                        @endif
                    </div>
                </form>
            </article>
        </section>
    </main>
@endsection
