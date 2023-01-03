@extends('layouts.auth')

@section('title', 'Login')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('auth.login') }}</h4>
        </div>

        <div class="card-body">
            <form method="POST"
                action="{{ route('login') }}"
                class="needs-validation"
                novalidate="">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('auth.email') }}</label>
                    <input id="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        tabindex="1"
                        value="{{ old('email') }}"
                        required
                        autofocus>
                    <div class="invalid-feedback">
                        @error('email')
                        {{ $message }}
                        @else
                        {{ __('validation.email', ['attribute' => 'Email']) }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password"
                            class="control-label">{{ __('auth.password') }}</label>
                        <!-- @if (Route::has('password.request'))
                        <div class="float-right">
                            <a href="auth-forgot-password.html"
                                class="text-small">
                                {{ __('Forgot Password?') }}
                            </a>
                        </div>
                        @endif -->
                    </div>
                    <input id="password"
                        type="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        tabindex="2"
                        required>
                    <div class="invalid-feedback">
                    @error('password')
                        {{ $message }}
                        @else
                        {{ __('validation.password') }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox"
                            name="remember"
                            class="custom-control-input"
                            tabindex="3"
                            id="remember-me"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label"
                            for="remember-me">{{ __('auth.remember_me') }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block"
                        tabindex="4">
                        {{ __('auth.login') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
    @if (Route::has('register'))
    <div class="text-muted mt-2 text-center">
        {{ __('auth.dont_have_an_account') }} 
        <a href="{{ route('register') }}">{{ __('auth.create_account') }}</a>
    </div>
    @endif
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
