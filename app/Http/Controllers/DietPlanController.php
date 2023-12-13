<?php

namespace App\Http\Controllers;

use App\Models\DietPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DietPlanController extends Controller
{
    public function index()
    {
        $dietPlans = DietPlan::all();

        return response()->json(['dietPlans' => $dietPlans]);
    }

    public function show($id)
    {
        $dietPlan = DietPlan::findOrFail($id);

        return view('plans.diet', compact('dietPlan'));
    }

    public function store(Request $request)
    {
        // Validate and store diet plan

        $dietPlan = new DietPlan([
            'trainer_id' => Auth::id(), // Set trainer_id to the currently authenticated user's id
            'name' => $request->input('diet_name'),
            'calories' => $request->input('calories'),
            'protein' => $request->input('protein'),
            'fats' => $request->input('fats'),
            'note' => $request->input('note'),
            // Add other fields as needed
        ]);

        $dietPlan->save();

        return redirect()->back()->with('success', 'Diet plan created successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate and update diet plan

        $dietPlan = DietPlan::findOrFail($id);
        $dietPlan->update([
            'trainer_id' => Auth::id(), // Update trainer_id to the currently authenticated user's id
            'name' => $request->input('diet_name'),
            'calories' => $request->input('calories'),
            'protein' => $request->input('protein'),
            'fats' => $request->input('fats'),
            'note' => $request->input('note'),
            // Add other fields as needed
        ]);

        return redirect()->back()->with('success', 'Diet plan updated successfully.');
    }

    public function delete($id)
    {
        $dietPlan = DietPlan::findOrFail($id);
        $dietPlan->delete();

        return redirect()->back()->with('success', 'Diet plan deleted successfully.');
    }
}
