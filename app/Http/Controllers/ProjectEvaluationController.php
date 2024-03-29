<?php

namespace App\Http\Controllers;

use App\Models\ProjectEvaluation;
use App\Http\Requests\StoreProjectEvaluationRequest;
use App\Http\Requests\UpdateProjectEvaluationRequest;

class ProjectEvaluationController extends Controller
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
     * @param  \App\Http\Requests\StoreProjectEvaluationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectEvaluationRequest $request)
    {
        ProjectEvaluation::create([
            'project_id' => $request->project_id,
            'evaluated_by' => auth()->user()->id,
            'evaluation' => $request->evaluation,
        ]);

        return to_route('projects.edit', ['project' => $request->project_id, 'ref' => 'recordEvaluasi'])
            ->with('message', __('dashboard.Successfully added an evaluation.'))
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectEvaluation  $projectEvaluation
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectEvaluation $projectEvaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectEvaluation  $projectEvaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectEvaluation $projectEvaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectEvaluationRequest  $request
     * @param  \App\Models\ProjectEvaluation  $projectEvaluation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectEvaluationRequest $request, ProjectEvaluation $projectEvaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectEvaluation  $projectEvaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectEvaluation $projectEvaluation)
    {
        $id = $projectEvaluation->project_id;
        $projectEvaluation->delete();

        return to_route('projects.edit', ['project' => $id, 'ref' => 'recordEvaluasi'])
            ->with('message', __('dashboard.Successfully removed the evaluation.'))
            ->with('status', 'success');
    }
}
