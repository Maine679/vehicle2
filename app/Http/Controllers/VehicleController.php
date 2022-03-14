<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isset($request->id)) {
            $user = User::find($request->id);
            $vehicles = Vehicle::all()->where('user_id',$request->id);
            return view('vehicles.index', compact('vehicles','user'));
        } else {
            $vehicles = Vehicle::get();
            return view('vehicles.index', compact('vehicles'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        $vehicle_types = VehicleType::get();
        return view('vehicles.form', compact('users', 'vehicle_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->only(['vehicle_name', 'type', 'vincode', 'number_plate', 'user_id']));

        return redirect()->route('vehicles.index')->withSuccess('Create vehicle ' . $request->vehicle_name);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        $users = User::get();
        $vehicle_types = VehicleType::get();

        return view('vehicles.form', compact('vehicle', 'users', 'vehicle_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleRequest $request
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->only('vehicle_name', 'type', 'vincode', 'number_plate', 'user_id'));
        return redirect()->route('vehicles.show', compact('vehicle'))->withSuccess('Vehicle ' . $vehicle->number_plate . ' data update success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Vehicle $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Vehicle $vehicle): \Illuminate\Http\RedirectResponse
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index')->withDanger('Vehicle' . $vehicle->vehicle_name . ' delete success');
    }
}
