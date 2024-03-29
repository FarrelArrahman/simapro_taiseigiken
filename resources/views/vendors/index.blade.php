@extends('layouts.app')

@section('title', __('dashboard.Vendor'))

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
                <h1>{{ __('dashboard.Vendor') }} </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('dashboard.Dashboard') }}</a></div>
                    <div class="breadcrumb-item active">{{ __('dashboard.Vendor') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('dashboard.Vendor List') }}</h4>
                                <div class="card-header-action">
                                    @can('create', \App\Models\Vendor::class)
                                    <a href="{{ route('vendors.create') }}"
                                        class="btn btn-primary btn-lg">
                                        {{ __('dashboard.Add Data') }}
                                    </a>
                                    @endcan
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table datatables">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>{{ __('dashboard.Name') }}</th>
                                                <th>{{ __('dashboard.Address') }}</th>
                                                <th>{{ __('dashboard.Phone Number') }}</th>
                                                <th>{{ __('dashboard.Status') }}</th>
                                                @can('editAny', \App\Models\Vendor::class)
                                                <th>{{ __('dashboard.Action') }}</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($vendors as $vendor)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $vendor->name }}</td>
                                                <td>{{ $vendor->address }}</td>
                                                <td>{{ $vendor->phone_number }}</td>
                                                <td>
                                                    <div class="badge badge-{{ $vendor->status->color() }}">{{ __('dashboard.' . $vendor->status->value) }}</div>
                                                </td>
                                                @can('update', $vendor)
                                                <td>
                                                    <a class="btn btn-warning btn-action mr-1"
                                                        href="{{ route('vendors.edit', $vendor->id) }}"
                                                        data-toggle="tooltip"
                                                        title="{{ __('dashboard.Edit') }}"><i class="fas fa-pencil-alt"></i></a>
                                                    <!-- <a class="btn btn-danger btn-action btn-delete"
                                                        data-toggle="tooltip"
                                                        title="Delete"
                                                        data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                        data-confirm-yes="deleteItem('{{ route('vendors.destroy', $vendor->id) }}')"><i class="fas fa-trash"></i></a> -->
                                                </td>
                                                @endcan
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <form id="deleteForm" action="{{ route('vendors.destroy', '') }}" method="POST">
        @method('DELETE')
        @csrf
    </form>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    <script src="{{ asset('js/datatable.js') }}"></script>
    @if(session()->has('message'))
    <script>
        let data = {
            message: "{{ session()->get('message') }}",
            status: "{{ session()->get('status') }}",
            position: 'topCenter',
        }
    </script>
    <script src="{{ asset('js/toastr.js') }}"></script>
    @endif
@endpush
