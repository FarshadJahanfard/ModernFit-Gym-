<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutAssignment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workout_assignments';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a WorkoutAssignment
     *
     * @var array
     */

    protected $fillable = [
        'member_id',
        'workout_plan_id',
        'start_date',
        'end_date',
        'note'
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class);
    }

    public function workoutLogs()
    {
        return $this->hasMany(WorkoutLog::class);
    }
}
