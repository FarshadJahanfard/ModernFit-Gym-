<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'branches';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Branch.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
    ];

    /**
     * Get all users of the branch.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function memberships() {
        return $this->hasMany(Membership::class);
    }
}
