<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutLog;
use App\Models\WorkoutAssignment;
use App\Models\WorkoutExercise;
use Illuminate\Support\Facades\Auth;

class WorkoutLogController extends Controller
{
    public function index()
    {
        // Add logic to fetch and display workout progress for members
        $user = Auth::user();
        $assignments = $user->assignedWorkouts;

        return view('workout_logs.index', compact('assignments'));
    }

    public function create($assignmentId)
    {
        $assignment = WorkoutAssignment::findOrFail($assignmentId);
        $exercises = WorkoutExercise::where('workout_plan_id', $assignment->workout_plan_id)->get();

        return view('workout_logs.create', compact('assignment', 'exercises'));
    }

    public function store(Request $request, $assignmentId)
    {
        $request->validate([
            'exercise_id' => 'required|exists:workout_exercises,id',
            'sets' => 'required|integer',
            'note' => 'nullable|string',
        ]);

        $exercise = WorkoutExercise::findOrFail($request->input('exercise_id'));

        $log = WorkoutLog::create([
            'assignment_id' => $assignmentId,
            'exercise_id' => $exercise->id,
            'sets' => $request->input('sets'),
            'note' => $request->input('note'),
        ]);

        return redirect()->route('workout_assignments.progress', ['assignmentId' => $assignmentId])
            ->with('success', 'Workout log added successfully.');
    }

    public function delete($id)
    {
        $user = Auth::user();
        $log = WorkoutLog::findOrFail($id);

        $member_id = $log->assignment->member_id;
        $trainer_id = $log->assignment->workoutPlan->user_id;

        // Check if the authenticated user has permission to delete the log
        if ($user->id == $member_id || $user->id == $trainer_id) {
            $log->delete();
            return redirect()->back()->with('success', 'Workout log deleted successfully.');
        }

        // If user does not have permission, redirect back with an error message
        return redirect()->back()->with('error', 'Unauthorized action: You do not have permission to delete this workout log.');
    }
}
