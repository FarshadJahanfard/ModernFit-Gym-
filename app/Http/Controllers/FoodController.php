<?php
// namespace App\Http\Controllers;

// use App\Models\Food;
// use Illuminate\Http\Request;

// class FoodController extends Controller
// {
//     public function showForm()
//     {
//         return view('food.form');
//     }

//     public function processForm(Request $request)
//     {
//         $validatedData = $request->validate([
//             'name' => 'required|string',
//             'quantity' => 'required|integer',
//             'calories' => 'required|integer',
//             'description' => 'required|string',
//             'vegetarian_option' => 'boolean',
//         ]);

//         // Create a new Food instance
//         $food = new Food([
//             'name' => $validatedData['name'],
//             'quantity' => $validatedData['quantity'],
//             'calories' => $validatedData['calories'],
//             'description' => $validatedData['description'],
//             'vegetarian' => $request->has('vegetarian_option'),
//         ]);

//         // Save the food item to the database
//         $food->save();

//         return "Data stored successfully!";
//     }
// }

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
            // 'quantity' => 'required|integer',
            'calories' => 'required|integer',
            'description' => 'required|string',
            'vegetarian_option' => 'boolean',
            'official_option' => 'boolean', // Add the new field for official option
        ]);

        // Create a new Food instance
        $food = new Food([
            'name' => $validatedData['name'],
            // 'quantity' => $validatedData['quantity'],
            'calories' => $validatedData['calories'],
            'description' => $validatedData['description'],
            'vegetarian' => $request->has('vegetarian_option'),
            'official' => $request->has('official_option'), // Set the official field
        ]);

        // Save the food item to the database
        $food->save();

        return "Data stored successfully!";
    }
}
