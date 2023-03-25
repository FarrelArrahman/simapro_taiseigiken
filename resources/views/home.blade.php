@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dashboard.Dashboard') }}</h1>
            </div>
            <div class="row">
                @if(in_array(auth()->user()->role, [\App\Enums\RoleEnum::ProjectHead, \App\Enums\RoleEnum::Worker]))
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('dashboard.Ongoing Project List') }}</h4>
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
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-helmet-safety"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{__('dashboard.Workers Count')}}</h4>
                            </div>
                            <div class="card-body">
                                {{ $worker_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('dashboard.Vendors Count') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $vendor_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-hourglass"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('dashboard.Ongoing Projects') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $project_ongoing_count }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __('dashboard.Done Projects') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $project_done_count }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>

    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    <script src="{{ asset('js/datatable.js') }}"></script>
@endpush
