<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Food;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = auth()->user();
    
        // Fetch the user's meals for the day (specify the created_at column from the foods table)
        // $meals = $user->foods()->whereDate('foods.created_at', today())->get();

        $meals = $user->foods()->get();
    
        // Calculate the total calories for the day
        $totalCalories = $meals->sum('calories');
    
        return view('dashboard.index', compact('meals', 'totalCalories'));
    }

    public function removeFood(Request $request, $id)
    {
        // Find the food item by ID
        $meal = Food::find($id);

        // Get the currently authenticated user
        $user = Auth::user();

        // Associate the food item with the user through the link table
        $user->foods()->detach($meal->id);

        // Redirect back to the nutrition page
        return redirect()->route('dashboard');
    }
}

