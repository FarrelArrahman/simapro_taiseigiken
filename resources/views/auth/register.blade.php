@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('dashboard.Register') }}</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">{{ __('dashboard.Full Name') }}</label>
                        <input id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            autofocus>
                    </div>
                    <div class="invalid-feedback">
                    @error('name')
                    {{ $message }}
                    @else
                    {{ 'Please fill in your full name' }}
                    @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">{{ __('dashboard.National Identity Number') }}</label>
                        <input id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="national_identity_number"
                            autofocus>
                    </div>
                    <div class="invalid-feedback">
                    @error('national_identity_number')
                    {{ $message }}
                    @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputGender">{{ __('dashboard.Gender') }}</label>
                    <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                            @selected(@old('gender') == "Male")
                            name="gender"
                            type="radio"
                            id="inputGenderMale"
                            value="Male">
                        <label class="form-check-label"
                            for="inputGenderMale">{{ __('dashboard.Male') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                            @selected(@old('gender') == "Female")
                            name="gender"
                            type="radio"
                            id="inputGenderFemale"
                            value="Female">
                        <label class="form-check-label"
                            for="inputGenderFemale">{{ __('dashboard.Female') }}</label>
                    </div>
                    @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}                                            
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email">
                    <div class="invalid-feedback">
                    @error('email')
                    {{ $message }}
                    @else
                    {{ 'Please fill in your email' }}
                    @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="password"
                            class="d-block">Password</label>
                        <input id="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password">
                        <div class="invalid-feedback">
                        @error('password')
                        {{ $message }}
                        @else
                        {{ 'Please fill in your password' }}
                        @enderror
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="password2"
                            class="d-block">Password Confirmation</label>
                        <input id="password2"
                            type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation">
                        <div class="invalid-feedback">
                        @error('password_confirmation')
                        {{ $message }}
                        @else
                        {{ 'Please fill in your password confirmation' }}
                        @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block">
                        Register
                    </button>
                </div>
            </form>
        </div>

    </div>
    @if (Route::has('login'))
    <div class="text-muted mt-2 text-center">
        Sudah punya akun? <a href="{{ route('login') }}">Login sekarang</a>
    </div>
    @endif
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>
@endpush
