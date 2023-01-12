@extends('layouts.app')

@section('title', __('dashboard.Edit Vendor'))

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dashboard.Edit Vendor') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('dashboard.Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('vendors.index') }}">{{ __('dashboard.Vendor') }}</a></div>
                    <div class="breadcrumb-item active">{{ __('dashboard.Edit Vendor') }}</div>
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
                                    <label for="inputName">{{ __('dashboard.Name') }}</label>
                                    <input type="text"
                                        name="name"
                                        value="{{ $vendors->name ?? old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="inputName">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">{{ __('dashboard.Address') }}</label>
                                    <input type="text"
                                        name="address"
                                        value="{{ $vendors->address ?? old('address') }}"
                                        class="form-control"
                                        id="inputAddress">
                                        @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputPhoneNumber">{{ __('dashboard.Phone Number') }}</label>
                                    <input type="text"
                                        name="phone_number"
                                        value="{{ $vendors->phone_number ?? old('phone_number') }}"
                                        class="form-control"
                                        id="inputPhoneNumber">
                                        @error('phone_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}                                            
                                        </div>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('dashboard.Status') }}</label>
                                    <select name="status" class="form-control form-control-lg">
                                        @foreach(\App\Enums\StatusEnum::activeCases() as $status)
                                        <option @selected($vendors->status->name == $status->name) value="{{ $status->value }}">{{ __('dashboard.' . $status->value) }}</option>
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
                                <a href="{{ route('vendors.index') }}" class="btn btn-lg btn-link">{{ __('dashboard.Back') }}</a>
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
