<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'calories', 'description', 'vegetarian'];
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
            'quantity' => $this->quantity,
            'calories' => $this->calories,
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
            'quantity' => $data['quantity'],
            'calories' => $data['calories'],
            'description' => $data['description'],
            'vegetarian' => $data['vegetarian'],
        ]);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}