<?php

namespace App\Http\Controllers\API;

use App\FoodSchedule;
use App\FoodScheduleDetail;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodScheduleResource;
use App\ScheduleFoodDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FoodScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FoodScheduleResource::collection(FoodSchedule::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), FoodSchedule::$rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $foodSchedule = FoodSchedule::whereDate('date',$request->date)->first();
        if ($foodSchedule == null) {
            $data['user_id'] = Auth::id();
            $data['date'] = $request->date;
            $foodSchedule = FoodSchedule::create($data);
        }

        $foodScheduleDetail = ['food_schedule_id' => $foodSchedule->id , 'food_id' => $request->food_id];
        if(FoodScheduleDetail::where($foodScheduleDetail)->count() == 0) {
            FoodScheduleDetail::create($foodScheduleDetail);
        }
        return $foodSchedule;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FoodSchedule  $foodSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(FoodSchedule $foodSchedule)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodSchedule  $foodSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodSchedule $foodSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodSchedule  $foodSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodSchedule $foodSchedule)
    {
        FoodScheduleDetail::where(['food_schedule_id' => $foodSchedule->id])->delete();
        $foodSchedule->delete();
        return response('', 204);
    }
}
