<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
