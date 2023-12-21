<?php
namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function showForm()
    {
        return view('food.form');
    }

    public function processForm(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'calories' => 'required|integer',
            'protein' => 'required|integer',
            'fat' => 'required|integer',
            'carbohydrates' => 'required|integer',
            'description' => 'required|string',
            'vegetarian_option' => 'boolean',
            'official_option' => 'boolean',
        ]);

        // Create a new Food instance
        $food = new Food([
            'name' => $validatedData['name'],
            'calories' => $validatedData['calories'],
            'protein' => $validatedData['protein'],
            'fat' => $validatedData['fat'],
            'carbohydrates' => $validatedData['carbohydrates'],
            'description' => $validatedData['description'],
            'vegetarian' => $request->has('vegetarian_option'),
            'official' => $request->has('official_option'),
        ]);

        // Save the food item to the database
        $food->save();

        return redirect()->route('nutrition.show')->with('success', 'Community Food created successfully');
    }
}
