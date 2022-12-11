@extends('layouts.app')

@section('title', 'Tambah Designator')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Designator</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('designators.index') }}">Designator</a></div>
                    <div class="breadcrumb-item active">Tambah Designator</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <form class="col-12" action="{{ route('designators.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Nama</label>
                                    <input type="text"
                                        name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="inputName"
                                        placeholder="Nama designator...">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputUnit">Unit</label>
                                    <select name="unit_id" class="form-control">
                                        @foreach($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}                                            
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputMaterial">Material</label>
                                    <input type="text"
                                        name="material"
                                        class="form-control @error('material') is-invalid @enderror"
                                        id="inputMaterial"
                                        placeholder="Material dari designator...">
                                        @error('material')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputServices">Services</label>
                                    <input type="text"
                                        name="services"
                                        class="form-control @error('services') is-invalid @enderror"
                                        id="inputServices"
                                        placeholder="Services dari designator...">
                                        @error('services')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Deskripsi</label>
                                    <input type="text"
                                        name="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        id="inputDescription"
                                        placeholder="Deskripsi atau keterangan designator...">
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
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
