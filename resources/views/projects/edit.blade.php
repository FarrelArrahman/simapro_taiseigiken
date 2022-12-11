@extends('layouts.app')

@section('title', 'Edit Project')

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
                                        <a class="nav-link active"
                                            id="project-data-tab"
                                            data-toggle="tab"
                                            href="#projectData"
                                            role="tab"
                                            aria-controls="projectData"
                                            aria-selected="true">Project Data</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
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
                                        <a class="nav-link"
                                            id="record-evaluasi-tab"
                                            data-toggle="tab"
                                            href="#recordEvaluasi"
                                            role="tab"
                                            aria-controls="recordEvaluasi"
                                            aria-selected="false">Record Evaluasi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
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
                                    <div class="tab-pane fade show active"
                                        id="projectData"
                                        role="tabpanel"
                                        aria-labelledby="project-data-tab">
                                        <form action="{{ route('projects.update', $projects->id) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group">
                                                <label for="inputProjectCode">Project Code</label>
                                                <input type="text"
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
                                                <select name="project_head_id" class="form-control">
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
                                                <select name="vendor_id" class="form-control">
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
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control form-control-lg">
                                                    @foreach(\App\Enums\StatusEnum::approvalCases() as $status)
                                                    <option @selected($projects->status->name == $status->name) value="{{ $status->value }}">{{ $status->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade"
                                        id="projectDesignator"
                                        role="tabpanel"
                                        aria-labelledby="project-designator-tab">
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
                                                        <th>Aksi</th>
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
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                    </div>
                                    <div class="tab-pane fade"
                                        id="curveS"
                                        role="tabpanel"
                                        aria-labelledby="curve-s-tab">
                                        Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur
                                        est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices.
                                        Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam
                                        convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis
                                        velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                                    </div>
                                    <div class="tab-pane fade"
                                        id="recordEvaluasi"
                                        role="tabpanel"
                                        aria-labelledby="record-evaluasi-tab">
                                        Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur
                                        est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices.
                                        Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam
                                        convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis
                                        velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                                    </div>
                                    <div class="tab-pane fade"
                                        id="updateProgress"
                                        role="tabpanel"
                                        aria-labelledby="update-progress-tab">
                                        <form action="{{ route('project_designators.update', $projects->id) }}" method="POST">
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
                                                        <th>Jumlah Awal</th>
                                                        <th>Jumlah Real</th>
                                                        <th>Selisih</th>
                                                        <th>Input Update</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($projects->projectDesignators as $projectDesignator)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $projectDesignator->designator->name }}</td>
                                                        <td>{{ $projectDesignator->designator->unit->name }}</td>
                                                        <td>{{ $projectDesignator->amount }}</td>
                                                        <td>{{ $projectDesignator->realization() }}</td>
                                                        <td>{{ $projectDesignator->amount - $projectDesignator->realization() }}</td>
                                                        <td>
                                                            <input min="0" class="form-control" type="number" name="{{ $projectDesignator->id }}">
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
                                                </div>
                                            </div>
                                        </form>
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
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    <script src="{{ asset('js/datatable.js') }}"></script>
@endpush
