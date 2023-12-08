<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Food;

class NutritionController extends Controller
{
    // public function show()
    // {
    //     // Retrieve all food items from the database
    //     $foods = Food::all();

    //     // Calculate the running total of calories
    //     $runningTotal = $foods->sum('calories');

    //     // Pass the food items and running total to the nutrition view
    //     return view('nutrition.show', compact('foods', 'runningTotal'));
    // }

    public function show()
    {
        // Retrieve community foods from the database
        $communityFoods = Food::where('official', false)->get();

        // Retrieve official foods from the database
        $officialFoods = Food::where('official', true)->get();

        // Calculate the running total of calories for community foods
        $communityRunningTotal = $communityFoods->sum('calories');

        // Calculate the running total of calories for official foods
        $officialRunningTotal = $officialFoods->sum('calories');

        // Pass the food items and running totals to the nutrition view
        return view('nutrition.show', compact('communityFoods', 'officialFoods', 'communityRunningTotal', 'officialRunningTotal'));
    }
    
    public function addFood(Request $request, $id)
    {
        // Find the food item by ID
        $food = Food::find($id);

        // Get the currently authenticated user
        $user = Auth::user();

        // Associate the food item with the user through the link table
        $user->foods()->attach($food->id);

        // Redirect back to the nutrition page
        return redirect()->route('nutrition.show');
    }
}
