<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'calories', 'protein', 'fat', 'carbohydrates', 'description', 'vegetarian', 'official', 'likes', 'dislikes'];
    protected $table = 'foods';

    /**
     * Get the custom JSON representation of the food item.
     *
     * @return string
     */
    public function toCustomJson(): string
    {
        return json_encode([
            'name' => $this->name,
            'calories' => $this->calories,
            'protein' => $this->protein,
            'fat' => $this->fat,
            'carbohydrates' => $this->carbohydrates,
            'description' => $this->description,
            'vegetarian' => $this->vegetarian,
        ]);
    }

    /**
     * Create a Food instance from custom JSON.
     *
     * @param string $json
     * @return Food
     */
    public static function fromCustomJson(string $json): Food
    {
        $data = json_decode($json, true);

        return new self([
            'name' => $data['name'],
            'calories' => $data['calories'],
            'protein' => $data['protein'],
            'fat' => $data['fat'],
            'carbohydrates' => $data['carbohydrates'],
            'description' => $data['description'],
            'vegetarian' => $data['vegetarian'],
        ]);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}