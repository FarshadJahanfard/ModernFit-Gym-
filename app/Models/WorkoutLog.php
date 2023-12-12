<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutLog extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'workout_logs';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a WorkoutLog
     *
     * @var array
     */

    protected $fillable = [
        'assignment_id',
        'exercise_id',
        'sets',
        'note'
    ];

    public function assignment()
    {
        return $this->belongsTo(WorkoutAssignment::class, 'assignment_id');
    }

    public function exercise()
    {
        return $this->belongsTo(WorkoutExercise::class, 'exercise_id')->withoutTrashed();
    }
    public function exerciseTrashed()
    {
        return $this->belongsTo(WorkoutExercise::class, 'exercise_id')->withTrashed();
    }
}
