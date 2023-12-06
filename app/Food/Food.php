<?php
namespace App\Food;

interface Food
{
    public function getName(): string;

    public function getQuantity(): int;

    public function getCalories(): int;

    public function getDescription(): string;
}