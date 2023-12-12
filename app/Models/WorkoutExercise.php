<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkoutExercise extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workout_exercises';

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
        'workout_plan_id',
        'exercise_name',
        'amount',
        'note'
    ];

    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class);
    }
}
