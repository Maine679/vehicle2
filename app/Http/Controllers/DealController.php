<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealRequest;
use App\Models\Deal;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $deals = Deal::get();
        return view('deals.index', compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $userOwner = User::find($request->user_id);
        $vehicle = Vehicle::find($request->vehicle_id);

        $users = User::all();

        return view('deals.form', compact('users', 'userOwner', 'vehicle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DealRequest $request)
    {
        $deal = Deal::create($request->only('buyer_id','vehicle_id','salesman_id','price','mileage'));

        $vehicle = Vehicle::find($request->vehicle_id);

        $vehicle->user_id = $request->buyer_id;
        $vehicle->save();

        $deals = Deal::all();

        return redirect()->route('deals.index', compact('deals'))->withSuccess('Deal ' . $deal->vehicle->vehicle_name. ' with ' . $deal->salesman->name . ' and ' . $deal->buyer->name . ' success.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Deal $deal
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Deal $deal)
    {
        return view('deals.show',compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Deal $deal
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Deal $deal)
    {
        $userOwner = User::find($deal->salesman->id);
        $vehicle = Vehicle::find($deal->vehicle_id);

        $userBuyer = User::find($deal->buyer->id);

        $users = User::all();

        return view('deals.form', compact('users', 'userOwner', 'vehicle', 'userBuyer', 'deal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Deal $deal
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Deal $deal)
    {
        $deal->update($request->only('buyer_id','price','mileage'));

        return view('deals.show',compact('deal'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Deal $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deal $deal)
    {
        $vehicle = Vehicle::find($deal->vehicle->id);

        //Раскручиваем последнюю операцию если она была последней (если нет - просто удаляем).
//        \Log::error('Veh_owner ' . $vehicle->user_id . ' deal_buyer ' . $deal->buyer_id);
        if($vehicle->user_id == $deal->buyer_id) {
            $vehicle->user_id = $deal->salesman_id;
            $vehicle->save();
        }

        $deal->delete();

        return redirect()->route('deals.index')->withWarning('Deal for '. $deal->vehicle->vehicle_name .' with ' . $deal->salesman->name . ' and ' . $deal->buyer->name . ' delete.');
    }
}
