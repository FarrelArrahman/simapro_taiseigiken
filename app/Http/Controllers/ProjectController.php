<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Designator;
use App\Models\ProjectWorker;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = auth()->user()->role;

        if($role == RoleEnum::Admin || $role == RoleEnum::Manager) {
            $this->data['projects'] = Project::latest()->get();
        } else if($role == RoleEnum::ProjectHead) {
            $this->data['projects'] = auth()->user()->headedProjects;
        } else {
            $projectWorkers = auth()->user()->projectWorkers;
            $this->data['projects'] = Project::find($projectWorkers->pluck('project_id'));
        }

        return view('projects.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Project::class);
        
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
        // $this->authorize('store', Project::class);

        Project::create([
            'project_code' => $request->project_code,
            'project_name' => $request->project_name,
            'address' => $request->address,
            'time_of_contract' => $request->time_of_contract,
            'drm_value' => str_replace('.', '', $request->drm_value),
            'project_head_id' => $request->project_head_id,
            'vendor_id' => $request->vendor_id,
            'begin_date' => $request->begin_date,
            'finish_date' => Carbon::createFromFormat('Y-m-d', $request->begin_date)
                ->addDays($request->time_of_contract),
            'status' => StatusEnum::Pending,
        ]);

        return to_route('projects.index')
            ->with('message', __('dashboard.Successfully added a new project.'))
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
        $projectWorkers = ProjectWorker::where('project_id', $project->id)->pluck('user_id');
        if(auth()->user()->role === RoleEnum::Worker && ! in_array(auth()->user()->id, $projectWorkers->toArray())) {
            return to_route('projects.index')
                ->with('message', __("dashboard.You don't have access to the project."))
                ->with('status', 'error');
        }

        $this->authorize('view', $project);

        $this->data['projects'] = $project;
        $this->data['designators'] = Designator::whereStatus(StatusEnum::Active)->get();
        $this->data['projectDesignators'] = $project->projectDesignators;
        $this->data['projectHeads'] = User::whereStatus(StatusEnum::Active)->whereRole(RoleEnum::ProjectHead)->get();
        $this->data['vendors'] = Vendor::whereStatus(StatusEnum::Active)->get();
        $this->data['users'] = User::whereStatus(StatusEnum::Active)
            ->whereRole(RoleEnum::Worker)
            ->whereNotIn('id', $projectWorkers)
            ->get();

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
        $this->authorize('update', $project);

        $project->update([
            'project_code' => $request->project_code,
            'project_name' => $request->project_name,
            'address' => $request->address,
            'time_of_contract' => $request->time_of_contract,
            'drm_value' => str_replace('.', '', $request->drm_value),
            'project_head_id' => $request->project_head_id,
            'vendor_id' => $request->vendor_id,
            'begin_date' => $request->begin_date,
            'finish_date' => Carbon::createFromFormat('Y-m-d', $request->begin_date)
                ->addDays($request->time_of_contract),
        ]);

        return to_route('projects.edit', $project->id)
            ->with('message', __('dashboard.Successfully changed the project.'))
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
            ->with('message', __('dashboard.Successfully deleted the project.'))
            ->with('status', 'success');
    }

    public function curveS(Project $project)
    {
        $updates = $planning = $realization = [];
        $cumulative = 0;
        $periods = CarbonPeriod::create($project->begin_date, $project->finish_date);

        foreach($project->projectDesignators as $projectDesignator) {
            foreach($periods as $key => $period) {
                $date = $period->format('Y-m-d');
                if( ! isset($updates[$key])) {
                    $updates[$key] = 0;
                }
                
                $updates[$key] += $projectDesignator
                    ->projectDesignatorProgressUpdates()
                    ->whereDate('created_at', $date)
                    ->whereStatus(StatusEnum::Approved)->sum('value') / $projectDesignator->amount;
            }
        }

        foreach($updates as $key => $update) {
            $planning[] = (++$key / count($updates));
            if($update > 0) {
                $realization[] = $cumulative + ($update / $project->projectDesignators->count());
                $cumulative += ($update / $project->projectDesignators->count());
            } else {
                $realization[] = null;
            }
        }
        
        return response()->json([
            'success' => true,
            'message' => "Curve S",
            'data' => [
                'dates' => collect($periods)->map(fn(Carbon $date) => $date->format('Y-m-d')),
                'planning' => collect($planning)->map(fn($value) => round($value, 2) * 100),
                'realization' => collect($realization)->map(fn($value) => $value != null ? round($value, 2) * 100 : null)
            ]
        ], 200);
    }

    public function addWorker(Project $project, User $user)
    {
        ProjectWorker::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'status' => StatusEnum::Active,
        ]);

        return to_route('projects.edit', ['project' => $project->id, 'ref' => 'projectWorker'])
            ->with('message', __('dashboard.Successfully added worker to the project.'))
            ->with('status', 'success');
    }

    public function deleteWorker(ProjectWorker $projectWorker)
    {
        $projectWorker->delete();

        return to_route('projects.edit', ['project' => $projectWorker->project_id, 'ref' => 'projectWorker'])
            ->with('message', __('dashboard.Successfully removed worker from the project.'))
            ->with('status', 'success');
    }
}
