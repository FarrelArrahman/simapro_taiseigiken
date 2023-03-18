@extends('layouts.app')

@section('title', __('dashboard.Edit Designator'))

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dashboard.Edit Designator') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('dashboard.Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('designators.index') }}">{{ __('dashboard.Designator') }}</a></div>
                    <div class="breadcrumb-item active">{{ __('dashboard.Edit Designator') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <form class="col-12" action="{{ route('designators.update', $designators->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                                <div class="form-group">
                                    <label for="inputName">{{ __('dashboard.Name') }}</label>
                                    <input type="text"
                                        name="name"
                                        value="{{ $designators->name ?? old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="inputName">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('dashboard.Unit') }}</label>
                                    <select name="unit_id" class="form-control form-control-lg">
                                        @foreach($units as $unit)
                                        <option @selected($designators->unit_id == $unit->id) value="{{ $unit->id }}">{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}                                            
                                    </div>
                                    @enderror
                                </div>
                                <!-- <div class="form-group">
                                    <label for="inputMaterial">{{ __('dashboard.Material') }}</label>
                                    <input type="text"
                                        name="material"
                                        value="{{ $designators->material ?? old('material') }}"
                                        class="form-control"
                                        id="inputMaterial">
                                        @error('material')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputServices">{{ __('dashboard.Service') }}</label>
                                    <input type="text"
                                        name="services"
                                        value="{{ $designators->services ?? old('services') }}"
                                        class="form-control"
                                        id="inputServices">
                                        @error('services')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div> -->
                                <div class="form-group">
                                    <label for="inputDescription">{{ __('dashboard.Description') }}</label>
                                    <input type="text"
                                        name="description"
                                        value="{{ $designators->description ?? old('description') }}"
                                        class="form-control"
                                        id="inputDescription">
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('dashboard.Status') }}</label>
                                    <select name="status" class="form-control form-control-lg">
                                        @foreach(\App\Enums\StatusEnum::activeCases() as $status)
                                        <option @selected($designators->status->name == $status->name) value="{{ $status->value }}">{{ __('dashboard.' . $status->value) }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}                                            
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-lg btn-primary">{{ __('dashboard.Submit') }}</button>
                                <a href="{{ route('designators.index') }}" class="btn btn-lg btn-link">{{ __('dashboard.Back') }}</a>
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
