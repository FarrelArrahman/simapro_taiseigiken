@extends('layouts.app')

@section('title', __('dashboard.Edit Unit'))

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dashboard.Edit Unit') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('dashboard.Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('units.index') }}">{{ __('dashboard.Unit') }}</a></div>
                    <div class="breadcrumb-item active">{{ __('dashboard.Edit Unit') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <form class="col-12" action="{{ route('units.update', $unit->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">{{ __('dashboard.Name') }}</label>
                                    <input type="text"
                                        name="name"
                                        value="{{ $unit->name ?? old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="inputName">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">{{ __('dashboard.Description') }}</label>
                                    <input type="text"
                                        name="description"
                                        value="{{ $unit->description ?? old('description') }}"
                                        class="form-control"
                                        id="inputDescription">
                                        @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control form-control-lg">
                                        @foreach(\App\Enums\StatusEnum::activeCases() as $status)
                                        <option @selected($unit->status->name == $status->name) value="{{ $status->value }}">{{ __('dashboard.' . $status->value) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-lg btn-primary">{{ __('dashboard.Submit') }}</button>
                                <a href="{{ route('units.index') }}" class="btn btn-lg btn-link">{{ __('dashboard.Back') }}</a>
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
