@extends('layouts.app')

@section('title', __('dashboard.Project'))

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
                <h1>{{ __('dashboard.Project') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('dashboard.Dashboard') }}</a></div>
                    <div class="breadcrumb-item active">{{ __('dashboard.Project') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('dashboard.Project List') }}</h4>
                                <div class="card-header-action">
                                    @can('create', App\Models\Project::class)
                                    <a href="{{ route('projects.create') }}"
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
                                                <th>{{ __('dashboard.Code') }}</th>
                                                <th>{{ __('dashboard.Project Name') }}</th>
                                                <th>{{ __('dashboard.Time of Contract') }}</th>
                                                <th>{{ __('dashboard.DRM Value') }}</th>
                                                <th>{{ __('dashboard.Project Head') }}</th>
                                                <th>{{ __('dashboard.Vendor') }}</th>
                                                <th>{{ __('dashboard.Completion') }}</th>
                                                {{-- <th>{{ __('dashboard.Status') }}Status</th> --}}
                                                <th>{{ __('dashboard.Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($projects as $project)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $project->project_code }}</td>
                                                <td>{{ $project->project_name }}</td>
                                                <td>{{ $project->time_of_contract }}</td>
                                                <td>{{ number_format($project->drm_value, 0, '', '.') }}</td>
                                                <td>{{ $project->projectHead->name }}</td>
                                                <td>{{ $project->vendor->name }}</td>
                                                <td>
                                                    <div class="progress mb-3">
                                                        <div class="progress-bar bg-success"
                                                            role="progressbar"
                                                            style="width: {{ $project->progress() }}%"
                                                            aria-valuenow="{{ $project->progress() }}"
                                                            aria-valuemin="0"
                                                            aria-valuemax="100">{{ $project->progress() }}%</div>
                                                    </div>
                                                </td>
                                                {{-- <td>
                                                    <div class="badge badge-{{ $project->status->color() }}">{{ $project->status->value }}</div>
                                                </td> --}}
                                                <td>
                                                    <a class="btn btn-info btn-block btn-action mr-1"
                                                        href="{{ route('projects.edit', $project->id) }}"
                                                        data-toggle="tooltip"
                                                        title="{{ __('dashboard.Show') }}"><i class="fas fa-eye"></i></a>
                                                    @can('delete', $project)
                                                    <a class="btn btn-danger btn-block btn-action btn-delete"
                                                        data-toggle="tooltip"
                                                        title="{{ __('dashboard.Delete') }}"
                                                        data-confirm="{{ __('dashboard.Are You Sure?') }}|{{ __('dashboard.This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="deleteItem('{{ route('projects.destroy', $project->id) }}')"><i class="fas fa-trash"></i></a>
                                                    @endcan
                                                </td>
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

    <form id="deleteForm" action="{{ route('projects.destroy', '') }}" method="POST">
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
