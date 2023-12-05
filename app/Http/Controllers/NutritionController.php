<?php

namespace App\Http\Controllers;

use App\Models\Food;

class NutritionController extends Controller
{
    // public function show()
    // {
    //     // Retrieve a food item from the database (you can adjust the query as needed)
    //     $food = Food::first();

    //     // Pass the food item to the nutrition view
    //     return view('nutrition.show', compact('food'));
    // }

    public function show()
    {
        // Retrieve all food items from the database
        $foods = Food::all();

        // Calculate the running total of calories
        $runningTotal = $foods->sum('calories');

        // Pass the food items and running total to the nutrition view
        return view('nutrition.show', compact('foods', 'runningTotal'));
    }
}
