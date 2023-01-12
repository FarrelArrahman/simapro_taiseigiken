<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['units'] = Unit::all();
        return view('units.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Unit::class);

        return view('units.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitRequest $request)
    {
        $this->authorize('create', Unit::class);

        Unit::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => StatusEnum::Active,
        ]);

        return to_route('units.index')
            ->with('message', __('dashboard.Successfully added a new unit.'))
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $this->authorize('update', $unit);
        
        $this->data['unit'] = $unit;
        return view('units.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitRequest  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $this->authorize('update', $unit);

        $unit->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => StatusEnum::from($request->status),
        ]);

        return to_route('units.index')
            ->with('message', __('dashboard.Successfully changed the unit.'))
            ->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        // $unit->update([
        //     'status' => StatusEnum::Inactive,
        // ]);

        // return to_route('units.index')
        //     ->with('message', __('dashboard.Successfully deleted the unit.'))
        //     ->with('status', 'success');
    }
}
