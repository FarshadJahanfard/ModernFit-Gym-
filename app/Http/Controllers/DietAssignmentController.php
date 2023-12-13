<?php

namespace App\Http\Controllers;

use App\Models\DietAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DietAssignmentController extends Controller
{
    public function create($planId)
    {
        // You can pass $planId to the view if needed

        return view('diet_assignments.create', compact('planId'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'plan_id' => 'required|exists:diet_plans,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'note' => 'nullable|string',
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Check if the user already has an active diet plan
        $activeAssignment = DietAssignment::where('user_id', $userId)
            ->where('end_date', '>=', now())
            ->first();

        if ($activeAssignment) {
            return redirect()->back()->with('error', 'You already have an active diet plan.');
        }

        // Create a new diet assignment
        DietAssignment::create([
            'user_id' => $userId,
            'plan_id' => $request->input('plan_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'note' => $request->input('note'),
        ]);

        return redirect()->back->with('success', 'Diet Plan assigned successfully.');
    }

    public function edit($id)
    {
        $dietAssignment = DietAssignment::findOrFail($id);

        return view('diet_assignments.edit', compact('dietAssignment'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update diet assignment

        return redirect()->route('diet_plans.index')->with('success', 'Diet Assignment updated successfully.');
    }

    public function destroy($id)
    {
        $dietAssignment = DietAssignment::findOrFail($id);
        $dietAssignment->delete();

        return redirect()->route('diet_plans.index')->with('success', 'Diet Assignment deleted successfully.');
    }
}
