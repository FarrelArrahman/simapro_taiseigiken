@extends('layouts.app')

@section('title', __('dashboard.Project Detail'))

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
    <link rel="stylesheet"
        href="{{ asset('css/easy-gantt.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('dashboard.Project Detail') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('dashboard.Dashboard') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('projects.index') }}">{{ __('dashboard.Project') }}</a></div>
                    <div class="breadcrumb-item active">{{ __('dashboard.Project Detail') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs"
                                    id="myTab2"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('ref') == 'projectData' || request()->query('ref') == '' ? 'active' : '' }}"
                                            id="project-data-tab"
                                            data-toggle="tab"
                                            href="#projectData"
                                            role="tab"
                                            aria-controls="projectData"
                                            aria-selected="true">{{ __('dashboard.Project Detail') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('ref') == 'projectWorker' ? 'active' : '' }}"
                                            id="project-data-tab"
                                            data-toggle="tab"
                                            href="#projectWorker"
                                            role="tab"
                                            aria-controls="projectWorker"
                                            aria-selected="true">{{ __('dashboard.Project Worker') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('ref') == 'projectDesignator' ? 'active' : '' }}"
                                            id="project-designator-tab"
                                            data-toggle="tab"
                                            href="#projectDesignator"
                                            role="tab"
                                            aria-controls="projectDesignator"
                                            aria-selected="true">{{ __('dashboard.Designator') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            id="timeline-tab"
                                            data-toggle="tab"
                                            href="#timeline"
                                            role="tab"
                                            aria-controls="timeline"
                                            aria-selected="false">{{ __('dashboard.Project Timeline') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            id="curve-s-tab"
                                            data-toggle="tab"
                                            href="#curveS"
                                            role="tab"
                                            aria-controls="curveS"
                                            aria-selected="false">{{ __('dashboard.Curve') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('ref') == 'recordEvaluasi' ? 'active' : '' }}"
                                            id="record-evaluasi-tab"
                                            data-toggle="tab"
                                            href="#recordEvaluasi"
                                            role="tab"
                                            aria-controls="recordEvaluasi"
                                            aria-selected="false">{{ __('dashboard.Evaluation Record') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('ref') == 'updateProgress' ? 'active' : '' }}"
                                            id="update-progress-tab"
                                            data-toggle="tab"
                                            href="#updateProgress"
                                            role="tab"
                                            aria-controls="updateProgress"
                                            aria-selected="false">{{ __('dashboard.Progress Updates') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-bordered"
                                    id="myTab3Content">
                                    <div class="tab-pane fade {{ request()->query('ref') == 'projectData' || request()->query('ref') == '' ? 'show active' : '' }}"
                                        id="projectData"
                                        role="tabpanel"
                                        aria-labelledby="project-data-tab">
                                        <h4 class="mt-3 mb-3">{{ __('dashboard.Project Detail') }}</h4>
                                        <form action="{{ route('projects.update', $projects->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group">
                                                <label for="inputProjectCode">{{ __('dashboard.Project Code') }}</label>
                                                <input type="text"
                                                    @cannot('update', $projects) disabled @endcannot
                                                    name="project_code"
                                                    class="form-control @error('project_code') is-invalid @enderror"
                                                    id="inputProjectCode"
                                                    placeholder="Project code..."
                                                    value="{{ $projects->project_code ?? old('project_code') }}">
                                                    @error('project_code')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}                                            
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputProjectName">{{ __('dashboard.Project Name') }}</label>
                                                <input type="text"
                                                    @cannot('update', $projects) disabled @endcannot
                                                    name="project_name"
                                                    class="form-control @error('project_name') is-invalid @enderror"
                                                    id="inputProjectName"
                                                    placeholder="Nama dari proyek..."
                                                    value="{{ $projects->project_name ?? old('project_name') }}">
                                                    @error('project_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}                                            
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress">{{ __('dashboard.Address') }}</label>
                                                <input type="text"
                                                    @cannot('update', $projects) disabled @endcannot
                                                    name="address"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    id="inputAddress"
                                                    value="{{ $projects->address ?? old('address') }}">
                                                    @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}                                            
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputTimeOfContract">{{ __('dashboard.Time of Contract') }}</label>
                                                <input type="text"
                                                    @cannot('update', $projects) disabled @endcannot
                                                    name="time_of_contract"
                                                    class="form-control @error('time_of_contract') is-invalid @enderror"
                                                    id="inputTimeOfContract"
                                                    placeholder="TOC project..."
                                                    value="{{ $projects->time_of_contract ?? old('time_of_contract') }}">
                                                    @error('time_of_contract')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}                                            
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDRMValue">{{ __('dashboard.DRM Value') }}</label>
                                                <input type="text"
                                                    @cannot('update', $projects) disabled @endcannot
                                                    name="drm_value"
                                                    class="form-control @error('drm_value') is-invalid @enderror"
                                                    id="inputDRMValue"
                                                    placeholder="Nilai DRM untuk proyek ini..."
                                                    value="{{ $projects->drm_value ?? old('drm_value') }}">
                                                    @error('drm_value')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}                                            
                                                    </div>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="inputProjectHead">{{ __('dashboard.Project Head') }}</label>
                                                <select
                                                    @cannot('update', $projects) disabled @endcannot 
                                                    name="project_head_id" 
                                                    class="form-control">
                                                    @foreach($projectHeads as $projectHead)
                                                    <option @selected($projects->projectHead->id == $projectHead->id) value="{{ $projectHead->id }}">{{ $projectHead->name }}</option>
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
                                                <select 
                                                    @cannot('update', $projects) disabled @endcannot
                                                    name="vendor_id" 
                                                    class="form-control">
                                                    @foreach($vendors as $vendor)
                                                    <option @selected($projects->vendor->id == $vendor->id) value="{{ $vendor->id }}">{{ $vendor->name }}</option>
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
                                                    @cannot('update', $projects) disabled @endcannot
                                                    name="begin_date"
                                                    class="form-control @error('begin_date') is-invalid @enderror"
                                                    id="inputBeginDate"
                                                    placeholder="Tanggal mulai project..."
                                                    value="{{ $projects->begin_date ?? old('begin_date') }}">
                                                    @error('begin_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}                                            
                                                    </div>
                                                    @enderror
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="inputFinishDate">Tanggal selesai</label>
                                                <input type="date"
                                                    @cannot('update', $projects) disabled @endcannot
                                                    name="finish_date"
                                                    class="form-control @error('finish_date') is-invalid @enderror"
                                                    id="inputFinishDate"
                                                    placeholder="Tanggal selesai project..."
                                                    value="{{ $projects->finish_date ?? old('finish_date') }}">
                                                    @error('finish_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}                                            
                                                    </div>
                                                    @enderror
                                            </div> -->
                                            {{-- <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control form-control-lg">
                                                    @foreach(\App\Enums\StatusEnum::approvalCases() as $status)
                                                    <option @selected($projects->status->name == $status->name) value="{{ $status->value }}">{{ $status->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            @can('update', $projects)
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('dashboard.Submit') }}</button>
                                                </div>
                                            </div>
                                            @endcan
                                        </form>
                                    </div>
                                    <!-- Worker -->
                                    <div class="tab-pane fade {{ request()->query('ref') == 'projectWorker' ? 'show active' : '' }}"
                                        id="projectWorker"
                                        role="tabpanel"
                                        aria-labelledby="project-designator-tab">
                                        <h4 class="mt-3 mb-3">{{ __('dashboard.Project Worker') }}
                                            @can('create', \App\Models\ProjectWorker::class)
                                            <button data-toggle="modal" data-target="#addWorkerModal" type="button" id="addDesignatorButton" class="btn btn-success float-right"><i class="fas fa-user mr-2"></i> {{ __('dashboard.Add Worker') }}</button>
                                            @endcan
                                        </h4>
                                        <div class="table-responsive">
                                            <table class="table-striped table datatables">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th>{{ __('dashboard.Name') }}</th>
                                                        <th>{{ __('dashboard.Role') }}</th>
                                                        <th>{{ __('dashboard.Status') }}</th>
                                                        @can('editAny', \App\Models\ProjectWorker::class)
                                                        <th width="10%">{{ __('dashboard.Action') }}</th>
                                                        @endcan
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($projects->projectWorkers as $projectWorker)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $projectWorker->user->name }}</td>
                                                        <td>{{ $projectWorker->user->role->value }}</td>
                                                        <td>
                                                            <div class="badge badge-{{ $projectWorker->status->color() }}">{{ $projectWorker->status->value }}</div>
                                                        </td>
                                                        @can('editAny', \App\Models\ProjectWorker::class)
                                                        <td>
                                                            <a href="#" class="btn btn-danger btn-action btn-delete"
                                                                data-toggle="tooltip"
                                                                title="{{ __('dashboard.Delete') }}"
                                                                data-confirm="{{ __('dashboard.Are You Sure?') }}|{{ __('dashboard.This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="deleteItem('{{ route('project.deleteWorker', $projectWorker->id) }}')"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                        @endcan
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ request()->query('ref') == 'projectDesignator' ? 'show active' : '' }}"
                                        id="projectDesignator"
                                        role="tabpanel"
                                        aria-labelledby="project-designator-tab">
                                        <h4 class="mt-3 mb-3">{{ __('dashboard.Designator') }}
                                        </h4>
                                        <div class="table-responsive">
                                            <table class="table-striped table datatables">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th>{{ __('dashboard.Designator') }}</th>
                                                        <th>{{ __('dashboard.Unit') }}</th>
                                                        <th>{{ __('dashboard.Job Description') }}</th>
                                                        <th>{{ __('dashboard.Working Date') }}</th>
                                                        <th>{{ __('dashboard.Amount') }}</th>
                                                        <th>{{ __('dashboard.Status') }}</th>
                                                        @can('update', $projects->projectDesignators->first())
                                                        <th width="75">{{ __('dashboard.Action') }}</th>
                                                        @endcan
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($projects->projectDesignators as $projectDesignator)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $projectDesignator->designator->name }}</td>
                                                        <td>{{ $projectDesignator->designator->unit->name }}</td>
                                                        <td>{{ $projectDesignator->designator->description }}</td>
                                                        <td>{{ $projectDesignator->begin_date ? $projectDesignator->begin_date->isoFormat('dddd, DD MMMM Y') : '-' }} - {{ $projectDesignator->finish_date ? $projectDesignator->finish_date->isoFormat('dddd, DD MMMM Y') : '-' }}</td>
                                                        <td>{{ $projectDesignator->amount }}</td>
                                                        <td>
                                                            <div class="badge badge-{{ $projectDesignator->status->color() }}">{{ $projectDesignator->status->value }}</div>
                                                        </td>
                                                        @can('update', $projectDesignator)
                                                        <td>
                                                            <!-- <a class="btn btn-warning btn-action mr-1"
                                                                href="{{ route('projects.edit', $projectDesignator->id) }}"
                                                                data-toggle="tooltip"
                                                                title="Edit"><i class="fas fa-pencil-alt"></i></a> -->
                                                            <a class="btn btn-danger btn-action btn-delete"
                                                                data-toggle="tooltip"
                                                                title="{{ __('dashboard.Delete') }}"
                                                                data-confirm="{{ __('dashboard.Are You Sure?') }}|{{ __('dashboard.This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="deleteItem('{{ route('project_designators.destroy', $projectDesignator->id) }}')"><i class="fas fa-trash"></i></a>
                                                            <a class="btn {{ $projectDesignator->status->value == 'Done' ? 'btn-dark' :  'btn-info' }} btn-action"
                                                                data-toggle="tooltip"
                                                                title="{{ $projectDesignator->status->value == 'Done' ? __('dashboard.Mark as undone') : __('dashboard.Mark as done') }}"
                                                                href="{{ route('changeDesignatorStatus', $projectDesignator->id) }}"><i class="{{ $projectDesignator->status->value == 'Done' ? 'fas fa-clock' :  'fas fa-check' }}"></i></a>
                                                        </td>
                                                        @endcan
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        @can('create', \App\Models\ProjectDesignator::class)
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <h4 class="mb-3">{{ __('dashboard.Add Designator') }}
                                                    @can('create', \App\Models\ProjectDesignator::class)
                                                    <button data-toggle="modal" data-target="#addDesignatorModal" type="button" id="addDesignatorButton" class="btn btn-success float-right"><i class="fas fa-list-check mr-2"></i> {{ __('dashboard.Designator List') }}</button>
                                                    @endcan
                                                </h4>
                                                <form action="{{ route('project_designators.store') }}" method="POST">
                                                    <input type="hidden" name="project_id" value="{{ $projects->id }}">
                                                    @csrf
                                                    <div class="table-responsive">
                                                        <table class="table-striped table">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('dashboard.Designator') }}</th>
                                                                    <th>{{ __('dashboard.Unit') }}</th>
                                                                    <th>{{ __('dashboard.Job Description') }}</th>
                                                                    <th>{{ __('dashboard.Start Date') }}</th>
                                                                    <th>{{ __('dashboard.End Date') }}</th>
                                                                    <th>{{ __('dashboard.Amount') }}</th>
                                                                    <th>{{ __('dashboard.Action') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="addDesignatorBody">
                                                                <tr id="addDesignatorRow">
                                                                    <td colspan="7" class="text-center">
                                                                        {{ __('dashboard.Click') }} <strong>{{ __('dashboard.Designator List') }}</strong> {{ __('dashboard.to view and add designators to this project.') }}
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <button id="submitDesignator" type="submit" class="btn btn-lg btn-primary btn-block">{{ __('dashboard.Submit') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endcan
                                    </div>
                                    <div class="tab-pane fade"
                                        id="timeline"
                                        role="tabpanel"
                                        aria-labelledby="curve-s-tab">
                                        <h4 class="mt-3 mb-3">{{ __('dashboard.Project Timeline') }}</h4>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="gantt"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade"
                                        id="curveS"
                                        role="tabpanel"
                                        aria-labelledby="curve-s-tab">
                                        <h4 class="mt-3 mb-3">{{ __('dashboard.Curve') }} <button type="button" class="btn btn-primary reloadCurveS float-right"><i class="fa fa-refresh mr-1"></i> {{ __('dashboard.Reload') }}</button></h4>
                                        <div class="row">
                                            <div class="col-12">
                                                <canvas id="curveSChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade {{ request()->query('ref') == 'recordEvaluasi' ? 'show active' : '' }}"
                                        id="recordEvaluasi"
                                        role="tabpanel"
                                        aria-labelledby="record-evaluasi-tab">
                                        <h4 class="mt-3 mb-3">{{ __('dashboard.Evaluation Record') }}</h4>
                                        @forelse($projects->projectEvaluations as $projectEvaluation)
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h4>{{ $projectEvaluation->evaluatedBy->name }} <div class="ml-1 badge badge-sm badge-{{ $projectEvaluation->evaluatedBy->role->color() }}">{{ __('dashboard.' . $projectEvaluation->evaluatedBy->role->value) }}</div></h4>
                                                <div class="card-header-action">
                                                    {{ $projectEvaluation->created_at->isoFormat('dddd, DD MMMM Y HH:mm') }}
                                                    @can('delete', $projectEvaluation)
                                                    <br>
                                                    <a class="btn btn-rounded btn-danger btn-delete"
                                                        data-toggle="tooltip"
                                                        title="{{ __('dashboard.Delete') }}"
                                                        data-confirm="{{ __('dashboard.Are You Sure?') }}|{{ __('dashboard.This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="deleteItem('{{ route('project_evaluations.destroy', $projectEvaluation->id) }}')"><i class="fa fa-trash ml-2"></i> {{ __('dashboard.Delete') }}</a>
                                                    @endcan
                                                </div>
                                            </div>
                                            <div class="card-body my-0 py-0">
                                                <p>{{ $projectEvaluation->evaluation }}</p>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="empty-state"
                                            data-height="200">
                                            <div class="empty-state-icon bg-danger mt-3">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <h2>{{ __('dashboard.Evaluation record not available') }}</h2>
                                            <p class="lead">
                                                {{ __('dashboard.Only manager can provide an evaluation that will be displayed in this section.') }} 
                                            </p>
                                        </div>
                                        @endforelse
                                        @can('create', \App\Models\ProjectEvaluation::class)
                                        <h4 class="mt-3 mb-3">{{ __('dashboard.Add evaluation') }}</h4>
                                        <form action="{{ route('project_evaluations.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{ $projects->id }}">
                                            <div class="form-group">
                                                <textarea name="evaluation" class="form-control" 
                                                    data-height="75"
                                                    placeholder="{{ __('dashboard.Give your evaluation') }}"></textarea>
                                            </div>
                                            <button type="submit" 
                                                class="btn btn-primary">{{ __('dashboard.Send') }}</button>
                                        </form>
                                        @endcan
                                    </div>
                                    <div class="tab-pane fade {{ request()->query('ref') == 'updateProgress' ? 'show active' : '' }}"
                                        id="updateProgress"
                                        role="tabpanel"
                                        aria-labelledby="update-progress-tab">
                                        @can('create', \App\Models\ProjectDesignatorProgressUpdate::class)
                                        <h4 class="mt-3 mb-3">{{ __('dashboard.Progress Updates') }} &mdash; {{ today()->isoFormat('dddd, DD MMMM Y') }}</h4>
                                        <form class="mb-3" action="{{ route('project_designators.update', $projects->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <table class="table-striped table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th>{{ __('dashboard.Designator') }}</th>
                                                        <th>{{ __('dashboard.Unit') }}</th>
                                                        <th>{{ __('dashboard.Initial Value') }}</th>
                                                        <th>{{ __('dashboard.Real Value') }}</th>
                                                        <th>{{ __('dashboard.Difference') }}</th>
                                                        <th>{{ __('dashboard.Input update') }}</th>
                                                        <th>{{ __('dashboard.Documentation') }}</th>
                                                        <th>{{ __('dashboard.Description') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($projects->projectDesignators->where('status', \App\Enums\StatusEnum::Incomplete) as $projectDesignator)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $projectDesignator->designator->name }}</td>
                                                        <td>{{ $projectDesignator->designator->unit->name }}</td>
                                                        <td>{{ $projectDesignator->amount }}</td>
                                                        <td>{{ $projectDesignator->realization() }}</td>
                                                        <td>{{ $projectDesignator->amount - $projectDesignator->realization() }}</td>
                                                        <td>
                                                            <input min="0" class="form-control update-input" type="number" name="value[{{ $projectDesignator->id }}]">
                                                        </td>
                                                        <td>
                                                            <input class="form-control update-input" type="file" name="content[{{ $projectDesignator->id }}]">
                                                        </td>
                                                        <td>
                                                            <input class="form-control update-input" type="text" name="description[{{ $projectDesignator->id }}]" autocomplete="off">
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center">{{ __('dashboard.The designator is not available for update.') }}</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            @if($projects->projectDesignators->where('status', \App\Enums\StatusEnum::Incomplete)->count() > 0)
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('dashboard.Submit') }}</button>
                                                </div>
                                            </div>
                                            @endif
                                        </form>
                                        @endcan

                                        <h4 class="mt-3 mb-3">{{ __('dashboard.Update History') }}</h4>
                                        @if($projects->projectDesignators->count() < 1)
                                        <div class="empty-state"
                                            data-height="200">
                                            <div class="empty-state-icon bg-danger mt-3">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <h2>{{ __('dashboard.Update history is not available') }}</h2>
                                            <p class="lead">
                                            {{ __('dashboard.The update history is not available for updating and commenting. Please add a designator and progress the update first.') }}
                                            </p>
                                        </div>
                                        @else
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="list-group"
                                                    id="list-tab"
                                                    role="tablist">
                                                    @foreach($projects->projectDesignators as $projectDesignator)
                                                    <a class="list-group-item list-group-item-action {{ $loop->iteration == 1 ? 'active' : '' }}"
                                                        id="list-{{ $projectDesignator->id }}-list"
                                                        data-toggle="list"
                                                        href="#list-{{ $projectDesignator->id }}"
                                                        role="tab">{{ $projectDesignator->designator->name }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-8 bg-secondary" style="max-height: 500px; overflow-y: scroll">
                                                <div class="tab-content"
                                                    id="nav-tabContent"
                                                    >
                                                    @foreach($projects->projectDesignators as $projectDesignator)
                                                    <div class="tab-pane fade {{ $loop->iteration == 1 ? 'show active' : '' }} border-0"
                                                        id="list-{{ $projectDesignator->id }}"
                                                        role="tabpanel"
                                                        aria-labelledby="list-{{ $projectDesignator->id }}-list">
                                                        <div class="activities mt-3">
                                                            @forelse($projectDesignator->projectDesignatorProgressUpdates as $update)
                                                            <div class="activity">
                                                                <div id="activity-{{ $update->id }}" class="activity-icon bg-{{ $update->status->color() }} shadow-{{ $update->status->color() }} text-white">
                                                                    <i id="activity-icon-{{ $update->id }}" class="{{ $update->status->icon() }}"></i>
                                                                </div>
                                                                <div class="activity-detail">
                                                                    <div class="mb-2">
                                                                        <span class="text-job text-primary">{{ $update->created_at->isoFormat('dddd, DD MMMM Y') }}</span>
                                                                        <span class="bullet"></span>
                                                                        <span class="text-job">
                                                                            {{ $update->value . ' ' . $update->projectDesignator->designator->unit->name }}
                                                                        </span>
                                                                        <div class="dropdown float-right">
                                                                            <a href="#!" 
                                                                                data-collapse="#mycard-collapse-{{ $update->id }}" class="toggle-minimize-{{ $update->id }}"><i class="fas fa-minus toggle-minimize-icon-{{ $update->id }}"></i></a>
                                                                            @can('update', $update)
                                                                            <a href="#"
                                                                                data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                                                            <div class="dropdown-menu">
                                                                                <div class="dropdown-title">{{ __('dashboard.Change Status') }}</div>
                                                                                <a data-id="{{ $update->id }}"
                                                                                    data-status="Approved" 
                                                                                    href="#!"
                                                                                    class="dropdown-item has-icon text-success update-progress-status"><i class="fas fa-check"></i> Approve</a>
                                                                                <a data-id="{{ $update->id }}"
                                                                                    data-status="Pending" 
                                                                                    href="#!"
                                                                                    class="dropdown-item has-icon text-warning update-progress-status"><i class="fas fa-clock"></i> Pending</a>
                                                                                <a data-id="{{ $update->id }}"
                                                                                    data-status="Rejected" 
                                                                                    href="#!"
                                                                                    class="dropdown-item has-icon text-danger update-progress-status"><i class="far fa-x"></i> Reject</a>
                                                                            </div>
                                                                            @endcan
                                                                        </div>
                                                                    </div>
                                                                    <div class="collapse show" id="mycard-collapse-{{ $update->id }}">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <span class="text-primary font-weight-bold">{{ $update->uploadedBy->name }}</span>
                                                                            </div>
                                                                            @if($update->description == null && $update->content == null)
                                                                            <div class="col-12">
                                                                                {!! "<em>{{ __('dashboard.This progress update does not have any description or documentation') }}</em>" !!}
                                                                            </div>
                                                                            @else
                                                                                @if($update->content != null)
                                                                                <div class="@if($update->description != null) col-4 @else col-12 @endif">
                                                                                    <div class="chocolat-parent mb-2">
                                                                                        <a href="{{ Storage::url($update->content) }}"
                                                                                            class="chocolat-image">
                                                                                            <div data-crop-image="150">
                                                                                                <img alt="image"
                                                                                                    src="{{ Storage::url($update->content) }}"
                                                                                                    class="img-fluid">
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                                @if($update->description != null)
                                                                                <div class="@if($update->content != null) col-8 ml-0 pl-0 @else col-12 @endif">
                                                                                    {{ $update->description }}
                                                                                </div>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <h6 class="mt-3 mb-3">{{ __('dashboard.Comment') }}</h6>
                                                                                <ul id="comment-ul-{{ $update->id }}" class="list-unstyled list-unstyled-border @if($update->comment == NULL && $update->commented_by == NULL) d-none @endif">
                                                                                    <li class="media">
                                                                                        <img alt="image"
                                                                                            class="rounded-circle mr-3"
                                                                                            width="50"
                                                                                            src="{{ asset('img/avatar/avatar-1.png') }}">
                                                                                        <div class="media-body">
                                                                                            <div id="commented-by-{{ $update->id }}" class="font-weight-bold mt-0 mb-1">{{ $update->commentedBy?->name }}</div>
                                                                                            <div id="comment-{{ $update->id }}">{{ $update?->comment }}</div>
                                                                                        </div>
                                                                                    </li>
                                                                                </ul>
                                                                                
                                                                                @can('update', $update)
                                                                                <form data-id="{{ $update->id }}" class="@if($update->comment != NULL && $update->commented_by != NULL) d-none @endif comment-form" id="comment-form-{{ $update->id }}" action="{{ route('project_designators.update', $update->id) }}">
                                                                                    <div class="form-group">
                                                                                        <textarea id="comment-textarea-{{ $update->id }}" class="form-control" 
                                                                                            data-height="75"
                                                                                            placeholder="{{ __('dashboard.Give your comment') }}"></textarea>
                                                                                    </div>
                                                                                    <button type="submit" 
                                                                                        class="btn btn-primary">{{ __('dashboard.Send') }}</button>
                                                                                </form>
                                                                                @endcan

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @empty
                                                            <div class="empty-state"
                                                                data-height="200">
                                                                <div class="empty-state-icon bg-danger">
                                                                    <i class="fas fa-times"></i>
                                                                </div>
                                                                <h2>{{ __('dashboard.Progress history is not available') }}</h2>
                                                                <p class="lead">
                                                                {{ __('dashboard.Please update the progress for the designator first in order to display the history.') }} 
                                                                </p>
                                                            </div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer">
                                <a href="{{ route('projects.index') }}" class="btn btn-lg btn-link">{{ __('dashboard.Back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<!-- Modal Designator -->
<div class="modal fade" id="addDesignatorModal" tabindex="-1" role="dialog" aria-labelledby="addDesignatorLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDesignatorLabel">{{ __('dashboard.Designator List') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table-striped table datatables" id="designatorTable">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>{{ __('dashboard.Designator') }}</th>
                            <th>{{ __('dashboard.Unit') }}</th>
                            <th>{{ __('dashboard.Job Description') }}</th>
                            <th>{{ __('dashboard.Material') }}</th>
                            <th>{{ __('dashboard.Service') }}</th>
                            <th>{{ __('dashboard.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($designators as $designator)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $designator->name }}</td>
                            <td>{{ $designator->unit->name }}</td>
                            <td>{{ $designator->description }}</td>
                            <td>{{ $designator->material }}</td>
                            <td>{{ $designator->services }}</td>
                            <td>
                                <a data-dismiss="modal" class="btn btn-success selectDesignator" 
                                    data-id="{{ $designator->id }}"
                                    data-name="{{ $designator->name }}"
                                    data-unit="{{ $designator->unit->name }}"
                                    data-description="{{ $designator->description }}"
                                    data-material="{{ $designator->material }}"
                                    data-services="{{ $designator->services }}">
                                    {{ __('dashboard.Choose') }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.Close') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Worker -->
<div class="modal fade" id="addWorkerModal" tabindex="-1" role="dialog" aria-labelledby="addWorkerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWorkerLabel">{{ __('dashboard.Worker List') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table-striped table datatables">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>{{ __('dashboard.Name') }}</th>
                            <th>{{ __('dashboard.Role') }}</th>
                            <th>{{ __('dashboard.Status') }}</th>
                            <th>{{ __('dashboard.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role->value }}</td>
                            <td>{{ $user->status->value }}</td>
                            <td>
                                <a href="{{ route('project.addWorker', ['project' => $projects->id, 'user' => $user->id]) }}" class="btn btn-success selectDesignator">
                                    {{ __('dashboard.Add') }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.Close') }}</button>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" action="{{ route('project_designators.destroy', '') }}" method="POST">
    @method('DELETE')
    @csrf
</form>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script src="{{ asset('js/easy-gantt.js') }}"></script>

    <script type="text/javascript">
        let counter = 0
        var curveSChart

        let toggleFirstDesignatorRow = () => {
            $('.designator').length > 0 ? $('#addDesignatorRow').hide() : $('#addDesignatorRow').show()
        }

        let toggleSubmitDesignator = () => {
            $('.designator').length > 0 ? $('#submitDesignator').show() : $('#submitDesignator').hide()
        }

        toggleSubmitDesignator()
        
        let assignDesignatorToProject = (designator) => {
            counter++
            let tr = `<tr class="designator designator-${counter}">
                <td>${designator.data('name')}</td>
                <td>${designator.data('unit')}</td>
                <td>${designator.data('description')}</td>
                <td>
                    <input class="form-control" 
                            type="hidden" 
                            value="${designator.data('id')}"
                            name="id[${designator.data('id')}]">
                    <input required class="form-control" 
                        type="date" 
                        value="{{ $projects->begin_date }}"
                        name="begin_date[${designator.data('id')}]">
                </td>
                <td>
                    <input required class="form-control" 
                        type="date" 
                        value="{{ $projects->begin_date }}"
                        name="finish_date[${designator.data('id')}]">
                </td>
                <td>
                    <input required class="form-control" 
                        type="number" 
                        name="amount[${designator.data('id')}]">
                </td>
                <td>
                    <button onclick="removeDesignator(${counter})" class="btn btn-danger">Hapus</button>
                </td>
            </tr>`

            $('#addDesignatorBody').append(tr)
            toggleFirstDesignatorRow()
            toggleSubmitDesignator()
        }

        $('#designatorTable').on('click', '.selectDesignator', function() {
            assignDesignatorToProject($(this))
        })

        $('.selectDesignator').on('click', function() {
            assignDesignatorToProject($(this))
        })

        let removeDesignator = (id) => {
            $('.designator-' + id).remove()
            toggleFirstDesignatorRow()
            toggleSubmitDesignator()
        }

        let updateProgress = (id, type, value) => {
            let url = "{{ route('progressUpdate', 'x') }}".replace('x', id)
            let body = {}
            if(type == "status") {
                body.status = value
            } else if(type == "comment") {
                body.comment = value
            }

            return fetch(url, {
                method: 'PUT',
                body: JSON.stringify(body),
                headers: {
                    "Content-Type": "application/json; charset=UTF-8",
                    "Accept": "application/json; charset=UTF-8",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            })
                .then((response) => response.json())
        }

        let getCurveS = () => {
            let url = "{{ route('project.curveS', $projects->id) }}"

            return fetch(url)
                .then((response) => response.json())
                .then((data) => setCurveS(data))
        }

        let setCurveS = (curveS) => {
            var ctx = document.getElementById("curveSChart").getContext('2d');
            if(curveSChart) {
                curveSChart.destroy()
            }
            curveSChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: curveS.data.dates,
                    datasets: [
                    {
                        label: "{{ __('dashboard.Realization') }}",
                        data: curveS.data.realization,
                        fill: false,
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        lineTension: 0,
                    },
                    {
                        label: "{{ __('dashboard.Planning') }}",
                        data: curveS.data.planning,
                        fill: false,
                        backgroundColor: 'rgb(122, 99, 255)',
                        borderColor: 'rgba(102, 99, 255, 1)',
                        lineTension: 0,
                    }
                    ],
                },
                options: {
                    scales: {
                    yAxes: [
                        {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            ticks: {
                                beginAtZero: true,
                            },
                        },
                    ],
                    },
                }
            })
        }

        getCurveS()

        $('.update-progress-status').on('click', function() {
            let id = $(this).data('id')
            let status = $(this).data('status')
            updateProgress(id, "status", status)
                .then((data) => {
                    $('#activity-' + data.data.id).removeClass('bg-primary bg-warning bg-danger shadow-primary shadow-warning shadow-danger')
                    $('#activity-icon-' + data.data.id).removeClass()
                    $('#activity-' + data.data.id).addClass('bg-' + data.data.status_color)
                    $('#activity-icon-' + data.data.id).addClass(data.data.icon)
                    getCurveS()
                })
        })

        $('.comment-form').on('submit', function(e) {
            e.preventDefault()
            let id = $(this).data('id')
            let comment = $('#comment-textarea-' + id).val()
            updateProgress(id, "comment", comment)
                .then((data) => {
                    $('#comment-ul-' + data.data.id).removeClass('d-none')
                    $('#comment-' + data.data.id).text(data.data.comment)
                    $('#commented-by-' + data.data.id).text(data.data.commented_by_name)
                    $('#comment-form-' + data.data.id).addClass('d-none')
                })
        })

        $('.reloadCurveS').click(function() {
            getCurveS()
        })
    </script>

    <script>

    var myTask = {!! json_encode($gantt) !!}

    moment.locale('id');

    $('.gantt').gantt({
        dtStart: "{{ $projects->begin_date }}",
        dtEnd: "{{ $projects->finish_date }}",
        height: 500,

        labelTask: true,
        data: myTask,
        click: function(taskId, taskName, taskCountDays){
            console.log('aqui', taskId, taskName, taskCountDays);
        }
    });
    </script>

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
