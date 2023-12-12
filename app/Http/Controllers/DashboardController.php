<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

use App\Models\Food;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = auth()->user();
    
        // Fetch the user's meals for the day (specify the created_at column from the foods table)

        $classes = $user->classes()->get();
        
        $meals = $user->foods()->get();
        // Calculate the total calories for the day
        $totalCalories = $meals->sum('calories');
    
        return view('dashboard.index', compact('meals', 'totalCalories', 'classes'));
    }

    public function detachFoods()
    {
        Artisan::call('foods:detach');

        return redirect()->route('dashboard')->with('success', 'Foods detached successfully.');
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
        return redirect()->route('dashboard')->with('success', 'Food has been removed successfully.');
    }

    public function removeClass(Request $request, $id)
    {
        // Find the food item by ID
        $class = OfferedClass::find($id);

        // Get the currently authenticated user
        $user = Auth::user();

        // Associate the food item with the user through the link table
        $user->foods()->detach($class->id);

        // Redirect back to the nutrition page
        return redirect()->route('dashboard')->with('success', 'You have successfully unregistered for this class.');
    }
}

