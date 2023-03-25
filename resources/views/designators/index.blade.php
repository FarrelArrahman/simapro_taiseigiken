@extends('layouts.app')

@section('title', __('dashboard.Designator'))

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
                <h1>{{ __('dashboard.Designator') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('dashboard.Dashboard') }}</a></div>
                    <div class="breadcrumb-item active">{{ __('dashboard.Designator') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('dashboard.Designator List') }}</h4>
                                <div class="card-header-action">
                                    @can('create', \App\Models\Designator::class)
                                    <a href="{{ route('designators.create') }}"
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
                                                <th>{{ __('dashboard.Unit') }}</th>
                                                <!-- <th>{{ __('dashboard.Material') }}</th> -->
                                                <!-- <th>{{ __('dashboard.Service') }}</th> -->
                                                <th>{{ __('dashboard.Description') }}</th>
                                                <th>{{ __('dashboard.Status') }}</th>
                                                @can('editAny', \App\Models\Designator::class)
                                                <th>{{ __('dashboard.Action') }}</th>
                                                @endcan
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($designators as $designator)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $designator->name }}</td>
                                                <td>{{ $designator->unit->name }}</td>
                                                <!-- <td>{{ $designator->material }}</td> -->
                                                <!-- <td>{{ $designator->services }}</td> -->
                                                <td>{{ $designator->description }}</td>
                                                <td>
                                                    <div class="badge badge-{{ $designator->status->color() }}">{{ __('dashboard.' . $designator->status->value) }}</div>
                                                </td>
                                                @can('editAny', $designator)
                                                <td>
                                                    <a class="btn btn-warning btn-action mr-1"
                                                        href="{{ route('designators.edit', $designator->id) }}"
                                                        data-toggle="tooltip"
                                                        title="{{ __('dashboard.Edit') }}"><i class="fas fa-pencil-alt"></i></a>
                                                    <!-- <a class="btn btn-danger btn-action btn-delete"
                                                        data-toggle="tooltip"
                                                        title="Delete"
                                                        data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                        data-confirm-yes="deleteItem('{{ route('designators.destroy', $designator->id) }}')"><i class="fas fa-trash"></i></a> -->
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

    <form id="deleteForm" action="{{ route('designators.destroy', '') }}" method="POST">
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
