@extends('layouts.app')

@section('title', 'Edit User')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></div>
                    <div class="breadcrumb-item active">Edit User</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <form class="col-12" action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Nama</label>
                                    <input type="text"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="inputName"
                                        placeholder="Nama user..."
                                        value="{{ $users->name ?? old('name') }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputNationalIdentityNumber">NIK (Nomor Induk Kependudukan) / Nomor Identitas</label>
                                    <input type="text"
                                        name="national_identity_number"
                                        class="form-control @error('national_identity_number') is-invalid @enderror"
                                        id="inputNationalIdentityNumber"
                                        placeholder="NIK / Nomor Identitas Anda..."
                                        value="{{ $users->national_identity_number ?? old('national_identity_number') }}">
                                        @error('national_identity_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email"
                                        name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="inputEmail"
                                        placeholder="Alamat email anda..."
                                        value="{{ $users->email ?? old('email') }}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label for="inputGender">Gender</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                            @checked($users->gender == "Male")
                                            name="gender"
                                            type="radio"
                                            id="inputGenderMale"
                                            value="Male">
                                        <label class="form-check-label"
                                            for="inputGenderMale">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                            @checked($users->gender == "Female")
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
                                <div class="form-group">
                                    <label for="inputAddress">Alamat</label>
                                    <input type="text"
                                        name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        id="inputAddress"
                                        placeholder="Alamat lokasi user..."
                                        value="{{ $users->address ?? old('address') }}">
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputPhoneNumber">Nomor telepon</label>
                                    <input type="text"
                                        name="phone_number"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        id="inputPhoneNumber"
                                        placeholder="Nomor telepon user..."
                                        value="{{ $users->phone_number ?? old('phone_number') }}">
                                        @error('phone_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputRole">Role</label>
                                    <select name="role" class="form-control">
                                        @foreach(\App\Enums\RoleEnum::cases() as $role)
                                        <option @selected($users->role->value == $role->value) value="{{ $role->value }}">{{ $role->value }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}                                            
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control form-control-lg">
                                        @foreach(\App\Enums\StatusEnum::activeCases() as $status)
                                        <option @selected($users->status->name == $status->name) value="{{ $status->value }}">{{ $status->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                <a href="{{ route('users.index') }}" class="btn btn-lg btn-link">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
