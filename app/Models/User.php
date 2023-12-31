<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoleAndPermission, Notifiable, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'activated',
        'token',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'activated',
        'token',
        'signup_ip_address',
        'signup_confirmation_ip_address',
        'signup_sm_ip_address',
        'admin_ip_address',
        'updated_ip_address',
        'deleted_ip_address',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                                => 'integer',
        'first_name'                        => 'string',
        'last_name'                         => 'string',
        'email'                             => 'string',
        'password'                          => 'string',
        'activated'                         => 'boolean',
        'token'                             => 'string',
        'signup_ip_address'                 => 'string',
        'signup_confirmation_ip_address'    => 'string',
        'signup_sm_ip_address'              => 'string',
        'admin_ip_address'                  => 'string',
        'updated_ip_address'                => 'string',
        'deleted_ip_address'                => 'string',
        'created_at'                        => 'datetime',
        'updated_at'                        => 'datetime',
        'deleted_at'                        => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the profile associated with the user.
     */
    public function profile()
    {
        return $this->hasOne(\App\Models\Profile::class);
    }

    /**
     * The profiles that belong to the user.
     */
    public function profiles()
    {
        return $this->belongsToMany(\App\Models\Profile::class)->withTimestamps();
    }

    /**
     * The branch that user belongs to.
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * All memberships of the user.
     */

    public function memberships()
    {
        return $this->belongsToMany(Membership::class)
            ->withPivot('start_date', 'end_date', 'passcode', 'branch_id');
    }

    /**
     * Active user's membership if exists.
     */

    public function activeMembership()
    {
        $today = now();

        $activeMembership = $this->memberships()
            ->wherePivot('end_date', '>=', $today)
            ->with('branch')
            ->first();

        if ($activeMembership) {
            $branchId = $activeMembership->pivot->branch_id;

            // Retrieve the branch using the branch_id from the pivot table
            $branch = Branch::find($branchId);

            $activeMembership->branch = $branch;
        }
        return $activeMembership;
    }

    /**
     * Check if a user has a profile.
     *
     * @param  string  $name
     * @return bool
     */
    public function hasProfile($name)
    {
        foreach ($this->profiles as $profile) {
            if ($profile->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add/Attach a profile to a user.
     *
     * @param  Profile  $profile
     */
    public function assignProfile(Profile $profile)
    {
        return $this->profiles()->attach($profile);
    }

    /**
     * Remove/Detach a profile to a user.
     *
     * @param  Profile  $profile
     */
    public function removeProfile(Profile $profile)
    {
        return $this->profiles()->detach($profile);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class)->withTimestamps();
    }

    public function classes()
    {
        return $this->belongsToMany(OfferedClass::class, 'classes_user', 'user_id', 'class_id');
    }

    public function likedFoods()
    {
        return $this->belongsToMany(Food::class, 'user_likes')->withTimestamps();
    }

    public function dislikedFoods()
    {
        return $this->belongsToMany(Food::class, 'user_dislikes')->withTimestamps();
    }

    public function workoutPlans() {
        return $this->hasMany(WorkoutPlan::class);
    }

    public function dietPlans() {
        return $this->hasMany(DietPlan::class, 'trainer_id');
    }


    /**
     * Get the members assigned to the trainer.
     */
    public function getMembers()
    {
        return User::whereHas('assignedWorkouts', function ($query) {
            $query->where('user_id', $this->id);
        })->get();
    }

    /**
     * Get the workout assignments for the user.
     */
    public function assignedWorkouts()
    {
        return $this->hasMany(WorkoutAssignment::class, 'member_id');
    }
    public function assignedDiets()
    {
        return $this->hasMany(DietAssignment::class, 'user_id');
    }

    public function foodLogs()
    {
        return $this->belongsToMany(Food::class)->withPivot('created_at');
    }
}
