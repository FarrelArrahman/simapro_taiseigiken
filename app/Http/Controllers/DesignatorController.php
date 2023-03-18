<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Designator;
use App\Http\Requests\StoreDesignatorRequest;
use App\Http\Requests\UpdateDesignatorRequest;
use App\Models\Unit;

class DesignatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['designators'] = Designator::all();
        return view('designators.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Designator::class);

        $this->data['units'] = Unit::active();
        return view('designators.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDesignatorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDesignatorRequest $request)
    {
        // $this->authorize('store', Designator::class);

        Designator::create([
            'name' => $request->name,
            'unit_id' => $request->unit_id,
            'material' => $request->material,
            'services' => $request->services,
            'description' => $request->description,
            'status' => StatusEnum::Active,
        ]);

        return to_route('designators.index')
            ->with('message', __('dashboard.Successfully added a new designator.'))
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designator  $designator
     * @return \Illuminate\Http\Response
     */
    public function show(Designator $designator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designator  $designator
     * @return \Illuminate\Http\Response
     */
    public function edit(Designator $designator)
    {
        $this->authorize('update', $designator);
        
        $this->data['designators'] = $designator;
        $this->data['units'] = Unit::active();
        return view('designators.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDesignatorRequest  $request
     * @param  \App\Models\Designator  $designator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDesignatorRequest $request, Designator $designator)
    {
        $this->authorize('update', $designator);

        $designator->update([
            'name' => $request->name,
            'unit_id' => $request->unit_id,
            // 'material' => $request->material,
            // 'services' => $request->services,
            'description' => $request->description,
            'status' => StatusEnum::from($request->status),
        ]);

        return to_route('designators.index')
            ->with('message', __('dashboard.Successfully changed the unit.'))
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designator  $designator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designator $designator)
    {
        // $this->authorize('delete', $designator);
    }
}
