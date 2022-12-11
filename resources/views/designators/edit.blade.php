@extends('layouts.app')

@section('title', 'Edit Designator')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Designator</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('designators.index') }}">Designator</a></div>
                    <div class="breadcrumb-item active">Edit Designator</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <form class="col-12" action="{{ route('designators.update', $designators->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Nama</label>
                                    <input type="text"
                                        name="name"
                                        value="{{ $designators->name ?? old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="inputName"
                                        placeholder="Nama atau istilah vendor...">
                                </div>
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select name="unit_id" class="form-control form-control-lg">
                                        @foreach($units as $unit)
                                        <option @selected($designators->unit_id == $unit->id) value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputMaterial">Material</label>
                                    <input type="text"
                                        name="material"
                                        value="{{ $designators->material ?? old('material') }}"
                                        class="form-control"
                                        id="inputMaterial"
                                        placeholder="Material dari designator...">
                                </div>
                                <div class="form-group">
                                    <label for="inputServices">Services</label>
                                    <input type="text"
                                        name="services"
                                        value="{{ $designators->services ?? old('services') }}"
                                        class="form-control"
                                        id="inputServices"
                                        placeholder="Services dari designator...">
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Deskripsi</label>
                                    <input type="text"
                                        name="description"
                                        value="{{ $designators->description ?? old('description') }}"
                                        class="form-control"
                                        id="inputDescription"
                                        placeholder="Deskripsi atau keterangan designator...">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control form-control-lg">
                                        @foreach(\App\Enums\StatusEnum::activeCases() as $status)
                                        <option @selected($designators->status->name == $status->name) value="{{ $status->value }}">{{ $status->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                <a href="{{ route('designators.index') }}" class="btn btn-lg btn-link">Kembali</a>
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
