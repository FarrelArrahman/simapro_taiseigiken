@extends('layouts.app')

@section('title', 'Edit Vendor')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Vendor</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('vendors.index') }}">Vendor</a></div>
                    <div class="breadcrumb-item active">Edit Vendor</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <form class="col-12" action="{{ route('vendors.update', $vendors->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Nama</label>
                                    <input type="text"
                                        name="name"
                                        value="{{ $vendors->name ?? old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="inputName"
                                        placeholder="Nama atau istilah vendor...">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Alamat</label>
                                    <input type="text"
                                        name="address"
                                        value="{{ $vendors->address ?? old('address') }}"
                                        class="form-control"
                                        id="inputAddress"
                                        placeholder="Deskripsi atau keterangan vendor...">
                                </div>
                                <div class="form-group">
                                    <label for="inputPhoneNumber">Nomor Telepon</label>
                                    <input type="text"
                                        name="phone_number"
                                        value="{{ $vendors->phone_number ?? old('phone_number') }}"
                                        class="form-control"
                                        id="inputPhoneNumber"
                                        placeholder="Nomor telepon vendor...">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control form-control-lg">
                                        @foreach(\App\Enums\StatusEnum::activeCases() as $status)
                                        <option @selected($vendors->status->name == $status->name) value="{{ $status->value }}">{{ $status->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                <a href="{{ route('vendors.index') }}" class="btn btn-lg btn-link">Kembali</a>
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
