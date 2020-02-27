<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodScheduleDetail extends Model
{
    /**
     * @var array
     *
     */
    public static $rules = [
        'food_schedule_id' => 'required|integer',
        'food_id' => 'required|integer'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
