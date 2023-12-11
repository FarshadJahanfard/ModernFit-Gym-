<?php

namespace App\Http\Controllers;

use App\Models\WorkoutLog;
use Illuminate\Http\Request;
use App\Models\WorkoutAssignment;
use App\Models\User;
use App\Models\WorkoutPlan;
use Illuminate\Support\Facades\Auth;

class WorkoutAssignmentController extends Controller
{
    public function create($planId)
    {
        $members = Auth::user()->getMembers(); // Assuming you have a method to get members in your User model
        $workoutPlan = WorkoutPlan::findOrFail($planId);

        return view('workout_assignments.create', compact('members', 'workoutPlan'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $workoutPlan = WorkoutPlan::findOrFail($request->input('plan_id'));

        // Find the member by username
        $member = User::where('name', $request->input('username'))->first();

        if (!$member) {
            // Handle the case where the member is not found (e.g., set a default value or show an error)
            return redirect()->back()->with('error', 'Member not found.');
        }

        WorkoutAssignment::create([
            'member_id' => $member->id,
            'workout_plan_id' => $workoutPlan->id,
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'note' => $request->input('note'),
        ]);

        return redirect()->route('workout_plans', ['username' => $user->name])
            ->with('success', 'Workout plan assigned successfully.');
    }

    public function progress($assignmentId)
    {
        $assignment = WorkoutAssignment::findOrFail($assignmentId);
        $logs = WorkoutLog::where('assignment_id', $assignment->id)->get();

        return view('workout_assignments.progress', compact('assignment', 'logs'));
    }

    public function userAssignments()
    {
        $user = Auth::user();
        $assignments = $user->assignedWorkouts()->with('workoutPlan')->get();

        return view('workout_assignments.member', compact('assignments'));
    }
}
