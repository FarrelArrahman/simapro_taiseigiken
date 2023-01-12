<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\ProjectDesignator;
use App\Http\Requests\StoreProjectDesignatorRequest;
use App\Http\Requests\UpdateProjectDesignatorRequest;
use App\Models\Project;
use App\Models\ProjectDesignatorProgressUpdate;
use Illuminate\Support\Facades\Request;

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
        $project = Project::findOrFail($request->project_id);
        $projectDesignators = $request->except(['project_id', '_token']);
        foreach($projectDesignators as $key => $value) {
            ProjectDesignator::create([
                'project_id' => $request->project_id,
                'designator_id' => $key,
                'designated_by' => auth()->user()->id,
                'amount' => $value,
                'status' => StatusEnum::Incomplete,
            ]);
        }

        return to_route('projects.edit', ['project' => $project->id, 'ref' => 'projectDesignator'])
            ->with('message', __('dashboard.Successfully added the designator to the project.'))
            ->with('status', 'success');
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
        // dd($projectDesignatorProgressUpdates);

        $data = [];
        
        foreach($projectDesignatorProgressUpdates as $fieldName => $field) {
            foreach($field as $key => $value) {
                if($value == null) {
                    continue;
                }

                $data[$key]['project_designator_id'] = $key;
                $data[$key]['status'] = StatusEnum::Pending;
                $data[$key]['uploaded_by'] = auth()->user()->id;
                $data[$key]['type'] = 'progress_update';
                $data[$key][$fieldName] = $value;

                if($fieldName == 'content') {
                    $data[$key][$fieldName] = $value->store('public/progress_updates');
                }
            }
        }

        foreach($data as $value) {
            ProjectDesignatorProgressUpdate::create($value);
        }

        return to_route('projects.edit', ['project' => $projectDesignator->id, 'ref' => 'updateProgress'])
            ->with('message', __('dashboard.Successfully updated the project progress.'))
            ->with('status', 'success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function progressUpdate(UpdateProjectDesignatorRequest $request, ProjectDesignatorProgressUpdate $update)
    {
        $data = [];
        $title = "mengubah status dari";
        
        if($request->has('status')) {
            $data['status'] = StatusEnum::from($request->status);
        } else if($request->has('comment')) {
            $data['comment'] = $request->comment;
            $data['commented_by'] = auth()->user()->id;
            $title = "memberi komentar pada";
        }

        $update->update($data);
        return response()->json([
            'success' => true,
            'message' => "Berhasil " . $title . " progress ini.",
            'data' => $update
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectDesignator  $projectDesignator
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectDesignator $projectDesignator)
    {
        $id = $projectDesignator->project_id;
        $projectDesignator->delete();

        return to_route('projects.edit', ['project' => $id, 'ref' => 'projectDesignator'])
            ->with('message', __('dashboard.Successfully removed the designator from the project.'))
            ->with('status', 'success');
    }

    /**
     * Change the status of the specified resource from storage.
     *
     * @param  \App\Models\ProjectDesignator  $projectDesignator
     * @return \Illuminate\Http\Response
     */
    public function changeDesignatorStatus(Request $request, ProjectDesignator $projectDesignator)
    {
        $projectDesignator->update([
            'status' => $projectDesignator->status === StatusEnum::Done 
                ? StatusEnum::Incomplete 
                : StatusEnum::Done
        ]);

        return to_route('projects.edit', ['project' => $projectDesignator->project_id, 'ref' => 'projectDesignator'])
            ->with('message', __('dashboard.Successfully changed the status of the designator.'))
            ->with('status', 'success');
    }
}
