<?php

namespace App\Http\Controllers\API;

use App\FoodScheduleDetail;
use App\Http\Resources\FoodScheduleDetailResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodScheduleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FoodScheduleDetailResource::collection(FoodScheduleDetail::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(FoodScheduleDetail::$rules);
        $scheduleDetail = null;

        $data['food_schedule_id'] = $request->food_schedule_id; //:TODO refactor when auth is implemented.
        $data['food_id'] = $request->food_id;

        $scheduleDetail = FoodScheduleDetail::where('food_id', $data['food_id'])
                                            ->where('food_schedule_id', $data['food_schedule_id'])
                                            ->first();

        if($scheduleDetail == null){
            $scheduleDetail = FoodScheduleDetail::create($data);
        }

        return $scheduleDetail;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FoodScheduleDetail  $foodScheduleDetail
     * @return \Illuminate\Http\Response
     */
    public function show(FoodScheduleDetail $foodScheduleDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodScheduleDetail  $foodScheduleDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodScheduleDetail $foodScheduleDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodScheduleDetail  $foodScheduleDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodScheduleDetail $foodScheduleDetail)
    {
        //$foodScheduleDetail->delete();
        dd($foodScheduleDetail);
        return response($foodScheduleDetail, 204);
    }
}
