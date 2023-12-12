<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferedClass extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'time'];
    protected $table = 'classes';

    /**
     * Get the custom JSON representation of the food item.
     *
     * @return string
     */
    public function toCustomJson(): string
    {
        return json_encode([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'time' => $this->time
        ]);
    }

    /**
     * Create a Food instance from custom JSON.
     *
     * @param string $json
     * @return OfferedClass
     */
    public static function fromCustomJson(string $json): OfferedClass
    {
        $data = json_decode($json, true);

        return new self([
            'title' => $data['title'],
            'description' => $data['description'],
            'date' => $data['date'],
            'time' => $data['time'],
        ]);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'classes_user', 'class_id', 'user_id');
    }
}