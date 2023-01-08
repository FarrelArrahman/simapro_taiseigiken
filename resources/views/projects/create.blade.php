@extends('layouts.app')

@section('title', __('dashboard.Add Project'))

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dashboard.Add Project') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('dashboard.Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('projects.index') }}">{{ __('dashboard.Project') }}</a></div>
                    <div class="breadcrumb-item active">{{ __('dashboard.Add Project') }}</div>
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
                                    <label for="inputProjectCode">{{ __('dashboard.Project Code') }}</label>
                                    <input type="text"
                                        name="project_code"
                                        class="form-control @error('project_code') is-invalid @enderror"
                                        id="inputProjectCode"
                                        value="{{ old('project_code') }}">
                                        @error('project_code')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputProjectName">{{ __('dashboard.Project Name') }}</label>
                                    <input type="text"
                                        name="project_name"
                                        class="form-control @error('project_name') is-invalid @enderror"
                                        id="inputProjectName"
                                        value="{{ old('project_name') }}">
                                        @error('project_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputTimeOfContract">{{ __('dashboard.Time of Contract') }}</label>
                                    <input type="text"
                                        name="time_of_contract"
                                        class="form-control @error('time_of_contract') is-invalid @enderror"
                                        id="inputTimeOfContract"
                                        value="{{ old('time_of_contract') }}">
                                        @error('time_of_contract')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputDRMValue">{{ __('dashboard.DRM Value') }}</label>
                                    <input type="text"
                                        name="drm_value"
                                        class="form-control @error('drm_value') is-invalid @enderror money"
                                        id="inputDRMValue"
                                        value="{{ old('drm_value') }}">
                                        @error('drm_value')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputProjectHead">{{ __('dashboard.Project Head') }}</label>
                                    <select name="project_head_id" class="form-control">
                                        <option value="" selected disabled>-- {{ __('dashboard.Project Head') }} --</option>
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
                                    <label for="inputVendor">{{ __('dashboard.Vendor') }}</label>
                                    <select name="vendor_id" class="form-control">
                                        <option value="" selected disabled>-- {{ __('dashboard.Vendor') }} --</option>
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
                                    <label for="inputBeginDate">{{ __('dashboard.Start Date') }}</label>
                                    <input type="date"
                                        name="begin_date"
                                        class="form-control @error('begin_date') is-invalid @enderror"
                                        id="inputBeginDate"
                                        value="{{ old('begin_date') ?? date('Y-m-d') }}">
                                        @error('begin_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-lg btn-primary">{{ __('dashboard.Submit') }}</button>
                                <a href="{{ route('projects.index') }}" class="btn btn-lg btn-link">{{ __('dashboard.Back') }}</a>
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
