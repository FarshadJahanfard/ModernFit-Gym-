<?php

namespace App\Http\Controllers;

use App\Models\DietAssignment;
use App\Models\DietPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DietAssignmentController extends Controller
{
    public function create($planId)
    {
        // You can pass $planId to the view if needed

        return view('diet_assignments.create', compact('planId'));
    }

//    public function store(Request $request)
//    {
//        // Validate the request
//        $request->validate([
//            'plan_id' => 'required|exists:diet_plans,id',
//            'start_date' => 'required|date',
//            'end_date' => 'required|date|after:start_date',
//            'note' => 'nullable|string',
//        ]);
//
//        // Get the authenticated user's ID
//        $userId = Auth::id();
//
//        // Check if the user already has an active diet plan
//        $activeAssignment = DietAssignment::where('user_id', $userId)
//            ->where('end_date', '>=', now())
//            ->first();
//
//        if ($activeAssignment) {
//            return redirect()->back()->with('error', 'You already have an active diet plan.');
//        }
//
//        // Create a new diet assignment
//        DietAssignment::create([
//            'user_id' => $userId,
//            'plan_id' => $request->input('plan_id'),
//            'start_date' => $request->input('start_date'),
//            'end_date' => $request->input('end_date'),
//            'note' => $request->input('note'),
//        ]);
//
//        return redirect()->back()->with('success', 'Diet Plan assigned successfully.');
//    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $dietPlan = DietPlan::findOrFail($request->input('plan_id'));

        // Find the member by username
        $member = User::where('name', $request->input('username'))->first();

        if (!$member) {
            // Handle the case where the member is not found (e.g., set a default value or show an error)
            return redirect()->back()->with('error', 'Member not found.');
        }

        DietAssignment::create([
            'user_id' => $member->id,
            'plan_id' => $dietPlan->id,
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'note' => $request->input('note'),
        ]);

        return redirect()->route('plans', ['username' => $user->name])
            ->with('success', 'Diet plan assigned successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate the request data as needed
        $this->validate($request, [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'note' => 'nullable|string|max:255', // Add validation for the 'note' field
            // Add more rules as needed
        ]);

        // Find the workout assignment by ID
        $assignment = DietAssignment::findOrFail($id);

        // Update the assignment data
        $assignment->start_date = $request->input('start_date');
        $assignment->end_date = $request->input('end_date');
        $assignment->note = $request->input('note'); // Update the 'note' field
        // Update other fields as needed

        // Save the updated assignment
        $assignment->save();

        return redirect()->route('diet_plans.show', ['id' => $assignment->plan->id])
            ->with('success', 'Workout assignment updated successfully.');
    }

    public function destroy($id)
    {
        $dietAssignment = DietAssignment::findOrFail($id);
        $dietAssignment->delete();

        return redirect()->back()->with('success', 'Diet Assignment deleted successfully.');
    }

    public function progress($assignmentId)
    {
        $assignment = DietAssignment::findOrFail($assignmentId);
        $user = $assignment->user;
        $logs = $user->foodLogs;

        return view('assignments.diet.progress', compact('assignment', 'logs'));
    }
}
