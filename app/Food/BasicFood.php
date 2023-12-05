<?php
namespace App\Food;

class BasicFood implements Food
{
    protected $name;
    protected $quantity;
    protected $calories;
    protected $description;

    public function __construct($name, $quantity, $calories, $description)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->calories = $calories;
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCalories(): int
    {
        return $this->calories;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function toJson(): string
    {
        return json_encode([
            'name' => $this->name,
            'quantity' => $this->quantity,
            'calories' => $this->calories,
            'description' => $this->description,
        ]);
    }

    public static function fromJson(string $json): BasicFood
    {
        $data = json_decode($json, true);

        return new self(
            $data['name'],
            $data['quantity'],
            $data['calories'],
            $data['description']
        );
    }
}