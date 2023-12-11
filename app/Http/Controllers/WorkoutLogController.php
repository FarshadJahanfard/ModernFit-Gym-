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

        $assignment = WorkoutAssignment::findOrFail($assignmentId);
        $exercise = WorkoutExercise::findOrFail($request->input('exercise_id'));

        $log = WorkoutLog::create([
            'assignment_id' => $assignmentId,
            'exercise_id' => $exercise->id,
            'sets' => $request->input('sets'),
            'note' => $request->input('note'),
        ]);

        return redirect()->route('workout_progress.index')->with('success', 'Workout log added successfully.');
    }
}
