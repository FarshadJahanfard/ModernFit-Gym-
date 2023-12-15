<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Models\OfferedClass;
use App\Models\Food;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $selectedDate = $request->input('date', now()->format('Y-m-d'));
        $classes = $user->classes()->get();
        $meals = $user->foods()->whereDate('food_user.created_at', $selectedDate)->get();
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
        $meal = Food::find($id);
        $user = Auth::user();
        $user->foods()->detach($meal->id);

        return redirect()->route('dashboard')->with('success', 'Food has been removed successfully.');
    }

    public function removeClass(Request $request, $id)
    {
        $class = OfferedClass::find($id);
        $user = Auth::user();
        $user->classes()->detach($class->id);

        return redirect()->route('dashboard')->with('success', 'You have successfully unregistered for this class.');
    }
}

