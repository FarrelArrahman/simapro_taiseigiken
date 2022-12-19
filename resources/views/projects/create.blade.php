@extends('layouts.app')

@section('title', 'Tambah Project')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Project</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('projects.index') }}">Project</a></div>
                    <div class="breadcrumb-item active">Tambah Project</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <form class="col-12" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <!-- <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div> -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputProjectCode">Project Code</label>
                                    <input type="text"
                                        name="project_code"
                                        class="form-control @error('project_code') is-invalid @enderror"
                                        id="inputProjectCode"
                                        placeholder="Project code..."
                                        value="{{ old('project_code') }}">
                                        @error('project_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputProjectName">Project Name</label>
                                    <input type="text"
                                        name="project_name"
                                        class="form-control @error('project_name') is-invalid @enderror"
                                        id="inputProjectName"
                                        placeholder="Nama dari proyek..."
                                        value="{{ old('project_name') }}">
                                        @error('project_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputTimeOfContract">Time of Contract (days)</label>
                                    <input type="text"
                                        name="time_of_contract"
                                        class="form-control @error('time_of_contract') is-invalid @enderror"
                                        id="inputTimeOfContract"
                                        placeholder="TOC project..."
                                        value="{{ old('time_of_contract') }}">
                                        @error('time_of_contract')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputDRMValue">Nilai DRM</label>
                                    <input type="text"
                                        name="drm_value"
                                        class="form-control @error('drm_value') is-invalid @enderror money"
                                        id="inputDRMValue"
                                        placeholder="Nilai DRM untuk proyek ini..."
                                        value="{{ old('drm_value') }}">
                                        @error('drm_value')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputProjectHead">Kepala Proyek</label>
                                    <select name="project_head_id" class="form-control">
                                        <option value="" selected disabled>-- Pilih Kepala Proyek --</option>
                                        @foreach($projectHeads as $projectHead)
                                        <option @selected(old('project_head_id') == $projectHead->id) value="{{ $projectHead->id }}">{{ $projectHead->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_head_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}                                            
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputVendor">Mitra</label>
                                    <select name="vendor_id" class="form-control">
                                        <option value="" selected disabled>-- Pilih Mitra --</option>
                                        @foreach($vendors as $vendor)
                                        <option @selected(old('vendor_id') == $vendor->id) value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}                                            
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputBeginDate">Tanggal mulai</label>
                                    <input type="date"
                                        name="begin_date"
                                        class="form-control @error('begin_date') is-invalid @enderror"
                                        id="inputBeginDate"
                                        placeholder="Tanggal mulai project..."
                                        value="{{ old('begin_date') ?? date('Y-m-d') }}">
                                        @error('begin_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                <a href="{{ route('projects.index') }}" class="btn btn-lg btn-link">Kembali</a>
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
