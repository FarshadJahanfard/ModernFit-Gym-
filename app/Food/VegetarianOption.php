<?php

namespace App\Food;

class VegetarianOption implements Food
{
    protected $food;

    public function __construct(Food $food)
    {
        $this->food = $food;
    }

    public function getName(): string
    {
        return $this->food->getName() . ' (Vegetarian)';
    }

    public function getQuantity(): int
    {
        return $this->food->getQuantity();
    }

    public function getCalories(): int
    {
        // You can modify the calories based on the vegetarian option.
        return $this->food->getCalories();
    }

    public function getDescription(): string
    {
        return $this->food->getDescription() . ' (Vegetarian)';
    }

    public function toJson(): string
    {
        return json_encode(['food' => json_decode($this->food->toJson(), true)]);
    }

    public static function fromJson(string $json): VegetarianOption
    {
        $data = json_decode($json, true);

        return new self(BasicFood::fromJson(json_encode($data['food'])));
    }
}
