<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\User;
use App\Models\Vendor;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['projects'] = Project::all();
        return view('projects.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['projectHeads'] = User::whereRole(RoleEnum::ProjectHead)->get();
        $this->data['vendors'] = Vendor::whereStatus(StatusEnum::Active)->get();
        return view('projects.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        Project::create([
            'project_code' => $request->project_code,
            'project_name' => $request->project_name,
            'time_of_contract' => $request->time_of_contract,
            'drm_value' => str_replace('.', '', $request->drm_value),
            'project_head_id' => $request->project_head_id,
            'vendor_id' => $request->vendor_id,
            'begin_date' => $request->begin_date,
            'finish_date' => $request->finish_date,
            'status' => StatusEnum::Pending,
        ]);

        return to_route('projects.index')
            ->with('message', 'Berhasil menambahkan project baru.')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);
        
        $this->data['projects'] = $project;
        $this->data['projectDesignators'] = $project->projectDesignators;
        $this->data['projectHeads'] = User::whereRole(RoleEnum::ProjectHead)->get();
        $this->data['vendors'] = Vendor::whereStatus(StatusEnum::Active)->get();

        return view('projects.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update([
            'project_code' => $request->project_code,
            'project_name' => $request->project_name,
            'time_of_contract' => $request->time_of_contract,
            'drm_value' => str_replace('.', '', $request->drm_value),
            'project_head_id' => $request->project_head_id,
            'vendor_id' => $request->vendor_id,
            'begin_date' => $request->begin_date,
            'finish_date' => $request->finish_date,
            'status' => StatusEnum::from($request->status),
        ]);

        return to_route('projects.index')
            ->with('message', 'Berhasil mengubah data project.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('projects.index')
            ->with('message', 'Berhasil menghapus data project.')
            ->with('status', 'success');
    }
}
