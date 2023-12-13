<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    use HasFactory;

    protected $fillable = ['trainer_id', 'name', 'calories', 'protein', 'fats', 'note'];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function assignments()
    {
        return $this->hasMany(DietAssignment::class);
    }
}

