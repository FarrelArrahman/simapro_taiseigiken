@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image"
                                    src="{{ Storage::disk('public')->exists(auth()->user()->profile_picture) ? Storage::url(auth()->user()->profile_picture) : asset('img/avatar/avatar-1.png') }}"
                                    class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Projects</div>
                                        <div class="profile-widget-item-value">187</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Terdaftar Pada</div>
                                        <div class="profile-widget-item-value">{{ auth()->user()->created_at->isoFormat('DD MMMM Y') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ auth()->user()->name }} <div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div> <strong class="text-{{ auth()->user()->role->color() }}">{{ auth()->user()->role->value }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="POST" action="{{ route('profileUpdate', auth()->user()->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-header">
                                    <h4>Edit Profil</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label for="inputName">Nama</label>
                                            <input type="text"
                                                name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                id="inputName"
                                                placeholder="Nama user..."
                                                value="{{ auth()->user()->name ?? old('name') }}">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}                                            
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label for="inputNationalIdentityNumber">NIK (Nomor Induk Kependudukan) / Nomor Identitas</label>
                                            <input type="text"
                                                name="national_identity_number"
                                                class="form-control @error('national_identity_number') is-invalid @enderror"
                                                id="inputNationalIdentityNumber"
                                                placeholder="NIK / Nomor Identitas Anda..."
                                                value="{{ auth()->user()->national_identity_number ?? old('national_identity_number') }}">
                                                @error('national_identity_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}                                            
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-7 col-12">
                                            <label for="inputEmail">Email</label>
                                            <input type="email"
                                                name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="inputEmail"
                                                placeholder="Alamat email anda..."
                                                value="{{ auth()->user()->email ?? old('email') }}">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}                                            
                                                </div>
                                                @enderror
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label for="inputPhoneNumber">Nomor telepon</label>
                                            <input type="text"
                                                name="phone_number"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                id="inputPhoneNumber"
                                                placeholder="Nomor telepon user..."
                                                value="{{ auth()->user()->phone_number ?? old('phone_number') }}">
                                                @error('phone_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}                                            
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label for="inputPassword">Password</label>
                                            <input type="password"
                                                name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="inputPassword"
                                                placeholder="(tidak diubah)"
                                                value="{{ old('password') }}">
                                                <small id="passwordHelpBlock"
                                                    class="form-text text-muted">
                                                    Kosongkan isian ini jika tidak ingin mengubah password.
                                                </small>
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}                                            
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="inputGender">Gender</label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input"
                                                    @checked(auth()->user()->gender == "Male")
                                                    name="gender"
                                                    type="radio"
                                                    id="inputGenderMale"
                                                    value="Male">
                                                <label class="form-check-label"
                                                    for="inputGenderMale">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input"
                                                    @checked(auth()->user()->gender == "Female")
                                                    name="gender"
                                                    type="radio"
                                                    id="inputGenderFemale"
                                                    value="Female">
                                                <label class="form-check-label"
                                                    for="inputGenderFemale">Perempuan</label>
                                            </div>
                                            @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}                                            
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label for="inputAddress">Alamat</label>
                                            <input type="text"
                                                name="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                id="inputAddress"
                                                placeholder="Alamat lokasi user..."
                                                value="{{ auth()->user()->address ?? old('address') }}">
                                                @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}                                            
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="inputProfilePicture">Foto Profil</label>
                                            <div class="custom-file">
                                                <input type="file"
                                                    name="profile_picture"
                                                    class="form-control">
                                                @error('profile_picture')
                                                <div class="invalid-feedback">
                                                    {{ $message }}                                            
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
