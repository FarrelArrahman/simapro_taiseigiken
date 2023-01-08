@extends('layouts.app')

@section('title', 'Edit Project')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/chocolat/dist/css/chocolat.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Project</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('projects.index') }}">Project</a></div>
                    <div class="breadcrumb-item active">Edit Project</div>
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
                                            aria-selected="true">Project Data</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('ref') == 'projectDesignator' ? 'active' : '' }}"
                                            id="project-designator-tab"
                                            data-toggle="tab"
                                            href="#projectDesignator"
                                            role="tab"
                                            aria-controls="projectDesignator"
                                            aria-selected="true">Project Designator</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            id="curve-s-tab"
                                            data-toggle="tab"
                                            href="#curveS"
                                            role="tab"
                                            aria-controls="curveS"
                                            aria-selected="false">Curve S</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('ref') == 'recordEvaluasi' ? 'active' : '' }}"
                                            id="record-evaluasi-tab"
                                            data-toggle="tab"
                                            href="#recordEvaluasi"
                                            role="tab"
                                            aria-controls="recordEvaluasi"
                                            aria-selected="false">Record Evaluasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->query('ref') == 'updateProgress' ? 'active' : '' }}"
                                            id="update-progress-tab"
                                            data-toggle="tab"
                                            href="#updateProgress"
                                            role="tab"
                                            aria-controls="updateProgress"
                                            aria-selected="false">Update Progress</a>
                                    </li>
                                </ul>
                                <div class="tab-content tab-bordered"
                                    id="myTab3Content">
                                    <div class="tab-pane fade {{ request()->query('ref') == 'projectData' || request()->query('ref') == '' ? 'show active' : '' }}"
                                        id="projectData"
                                        role="tabpanel"
                                        aria-labelledby="project-data-tab">
                                        <h4 class="mt-3 mb-3">Project Data</h4>
                                        <form action="{{ route('projects.update', $projects->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group">
                                                <label for="inputProjectCode">Project Code</label>
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
                                                <label for="inputProjectName">Project Name</label>
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
                                                <label for="inputTimeOfContract">Time of Contract (days)</label>
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
                                                <label for="inputDRMValue">Nilai DRM</label>
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
                                                <label for="inputProjectHead">Kepala Proyek</label>
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
                                                <label for="inputVendor">Mitra</label>
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
                                                <label for="inputBeginDate">Tanggal mulai</label>
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
                                            <div class="form-group">
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
                                            </div>
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
                                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                                                </div>
                                            </div>
                                            @endcan
                                        </form>
                                    </div>
                                    <div class="tab-pane fade {{ request()->query('ref') == 'projectDesignator' ? 'show active' : '' }}"
                                        id="projectDesignator"
                                        role="tabpanel"
                                        aria-labelledby="project-designator-tab">
                                        <h4 class="mt-3 mb-3">Project Designator</h4>
                                        <div class="table-responsive">
                                            <table class="table-striped table datatables">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Designator</th>
                                                        <th>Unit</th>
                                                        <th>Uraian Pekerjaan</th>
                                                        <th>Jumlah</th>
                                                        <th>Status</th>
                                                        @can('update', $projects->projectDesignators->first())
                                                        <th width="75">Aksi</th>
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
                                                                title="Delete"
                                                                data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                                data-confirm-yes="deleteItem('{{ route('project_designators.destroy', $projectDesignator->id) }}')"><i class="fas fa-trash"></i></a>
                                                            <a class="btn {{ $projectDesignator->status->value == 'Done' ? 'btn-dark' :  'btn-info' }} btn-action"
                                                                data-toggle="tooltip"
                                                                title="{{ $projectDesignator->status->value == 'Done' ? 'Tandai belum selesai' :  'Tandai selesai' }}"
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
                                                <h4 class="mb-3">Designator 
                                                    @can('create', \App\Models\ProjectDesignator::class)
                                                    <button data-toggle="modal" data-target="#addDesignatorModal" type="button" id="addDesignatorButton" class="btn btn-success float-right"><i class="fas fa-list-check mr-2"></i> Daftar Designator</button>
                                                    @endcan
                                                </h4>
                                                <form action="{{ route('project_designators.store') }}" method="POST">
                                                    <input type="hidden" name="project_id" value="{{ $projects->id }}">
                                                    @csrf
                                                    <div class="table-responsive">
                                                        <table class="table-striped table">
                                                            <thead>
                                                                <tr>
                                                                    <th>Designator</th>
                                                                    <th>Unit</th>
                                                                    <th>Uraian Pekerjaan</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="addDesignatorBody">
                                                                <tr id="addDesignatorRow">
                                                                    <td colspan="5" class="text-center">
                                                                        Klik tombol <strong>Daftar Designator</strong> untuk melihat dan menambahkan designator pada project ini.
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <button id="submitDesignator" type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endcan
                                    </div>
                                    <div class="tab-pane fade"
                                        id="curveS"
                                        role="tabpanel"
                                        aria-labelledby="curve-s-tab">
                                        <h4 class="mt-3 mb-3">Curve S <button type="button" class="btn btn-primary reloadCurveS float-right"><i class="fa fa-refresh mr-1"></i> Reload</button></h4>
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
                                        <h4 class="mt-3 mb-3">Record Evaluasi</h4>
                                        @forelse($projects->projectEvaluations as $projectEvaluation)
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h4>{{ $projectEvaluation->evaluatedBy->name }}</h4>
                                                <div class="card-header-action">
                                                    {{ $projectEvaluation->created_at->isoFormat('dddd, DD MMMM Y HH:mm') }}
                                                    WITA
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
                                            <h2>Record evaluasi tidak tersedia</h2>
                                            <p class="lead">
                                                Admin atau Kepala Proyek dapat memberikan evaluasi yang akan ditampilkan pada bagian ini. 
                                            </p>
                                        </div>
                                        @endforelse
                                        @can('create', \App\Models\ProjectEvaluation::class)
                                        <h4 class="mt-3 mb-3">Tambah Evaluasi</h4>
                                        <form action="{{ route('project_evaluations.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{ $projects->id }}">
                                            <div class="form-group">
                                                <textarea name="evaluation" class="form-control" 
                                                    data-height="75"
                                                    placeholder="Berikan evaluasi Anda..."></textarea>
                                            </div>
                                            <button type="submit" 
                                                class="btn btn-primary">Kirim</button>
                                        </form>
                                        @endcan
                                    </div>
                                    <div class="tab-pane fade {{ request()->query('ref') == 'updateProgress' ? 'show active' : '' }}"
                                        id="updateProgress"
                                        role="tabpanel"
                                        aria-labelledby="update-progress-tab">
                                        <h4 class="mt-3 mb-3">Update Progress &mdash; {{ today()->isoFormat('dddd, DD MMMM Y') }}</h4>
                                        <form action="{{ route('project_designators.update', $projects->id) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <table class="table-striped table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Designator</th>
                                                        <th>Unit</th>
                                                        <th width="5%">Jml Awal</th>
                                                        <th width="5%">Jml Real</th>
                                                        <th width="5%">Selisih</th>
                                                        <th width="12.5%">Input Update</th>
                                                        <th>Dokumentasi</th>
                                                        <th>Keterangan</th>
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
                                                        <td colspan="9" class="text-center">Designator tidak tersedia untuk di-update.</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            @if($projects->projectDesignators->where('status', \App\Enums\StatusEnum::Incomplete)->count() > 0)
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                                                </div>
                                            </div>
                                            @endif
                                        </form>

                                        <h4 class="mt-5 mb-3">Histori Update</h4>
                                        @if($projects->projectDesignators->count() < 1)
                                        <div class="empty-state"
                                            data-height="200">
                                            <div class="empty-state-icon bg-danger mt-3">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <h2>Histori update tidak tersedia</h2>
                                            <p class="lead">
                                                Histori update tidak tersedia untuk di-update dan diberi komentar. Silahkan tambahkan designator dan lakukan progress update terlebih dahulu.
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
                                                                                <div class="dropdown-title">Ubah Status</div>
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
                                                                                {!! "<em>Update progress ini tidak memiliki deskripsi atau dokumentasi apapun</em>" !!}
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
                                                                                <h6 class="mt-3 mb-3">Komentar</h6>
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
                                                                                            placeholder="Berikan komentar Anda..."></textarea>
                                                                                    </div>
                                                                                    <button type="submit" 
                                                                                        class="btn btn-primary">Kirim</button>
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
                                                                <h2>Histori progress tidak tersedia</h2>
                                                                <p class="lead">
                                                                    Silakan update progress untuk designator terlebih dahulu agar dapat menampilkan histori. 
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
                                <a href="{{ route('projects.index') }}" class="btn btn-lg btn-link">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<!-- Modal -->
<div class="modal fade" id="addDesignatorModal" tabindex="-1" role="dialog" aria-labelledby="addDesignatorLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDesignatorLabel">Daftar Designator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table-striped table datatables">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Designator</th>
                            <th>Unit</th>
                            <th>Uraian Pekerjaan</th>
                            <th>Material</th>
                            <th>Jasa</th>
                            <th>Aksi</th>
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
                                    Pilih
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

        $('.selectDesignator').on('click', function() {
            counter++
            let designator = $(this)
            let tr = `<tr class="designator designator-${counter}">
                <td>${designator.data('name')}</td>
                <td>${designator.data('unit')}</td>
                <td>${designator.data('description')}</td>
                <td>
                    <input required class="form-control" 
                        type="number" 
                        name="${designator.data('id')}">
                </td>
                <td>
                    <button onclick="removeDesignator(${counter})" class="btn btn-danger">Hapus</button>
                </td>
            </tr>`

            $('#addDesignatorBody').append(tr)
            toggleFirstDesignatorRow()
            toggleSubmitDesignator()
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
                        label: 'Realisasi',
                        data: curveS.data.realization,
                        fill: false,
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        lineTension: 0,
                    },
                    {
                        label: 'Planning',
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
