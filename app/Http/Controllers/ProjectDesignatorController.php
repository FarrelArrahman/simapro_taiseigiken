<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\ProjectDesignator;
use App\Http\Requests\StoreProjectDesignatorRequest;
use App\Http\Requests\UpdateProjectDesignatorRequest;
use App\Models\Project;
use App\Models\ProjectDesignatorProgressUpdate;

class ProjectDesignatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectDesignatorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectDesignatorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectDesignator  $projectDesignator
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectDesignator $projectDesignator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectDesignator  $projectDesignator
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectDesignator $projectDesignator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectDesignatorRequest  $request
     * @param  \App\Models\ProjectDesignator  $projectDesignator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectDesignatorRequest $request, Project $projectDesignator)
    {
        $projectDesignatorProgressUpdates = $request->except(['_method', '_token']);
        
        foreach($projectDesignatorProgressUpdates as $key => $value) {
            ProjectDesignatorProgressUpdate::create([
                'project_designator_id' => $key,
                'content' => '',
                'type' => 'progress_update',
                'value' => $value,
                'status' => StatusEnum::Pending,
                'uploaded_by' => auth()->user()->id,
            ]);
        }

        return to_route('projects.edit', $projectDesignator->id)
            ->with('message', 'Berhasil mengupdate progress project.')
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectDesignator  $projectDesignator
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectDesignator $projectDesignator)
    {
        //
    }
}
