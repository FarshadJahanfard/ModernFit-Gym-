<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayPass extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'day_passes';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a DayPass
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'passcode',
        'start_date',
        'end_date',
        'branch_id'
    ];

    /**
     * Get all users with active passes.
     */

    public static function activePasses()
    {
        $today = now()->toDateString();

        return self::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->get();
    }
}
