<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workout_plans';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a WorkoutExercise
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function exercises()
    {
        return $this->hasMany(WorkoutExercise::class);
    }
}