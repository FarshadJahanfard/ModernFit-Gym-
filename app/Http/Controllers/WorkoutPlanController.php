<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutPlan;
use App\Models\WorkoutExercise;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanController extends Controller
{
    public function create()
    {
        return view('plans.create');
    }

    public function index()
    {
        $user = Auth::user();
        $workoutPlans = $user->workoutPlans;

        return view('plans.index', compact('workoutPlans'));
    }

    public function show($id)
    {
        $workoutPlan = WorkoutPlan::findOrFail($id);
        $assignedMembers = $workoutPlan->assignedMembers;

        return view('plans.show', compact('workoutPlan', 'assignedMembers'));
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        $workoutPlan = WorkoutPlan::create([
            'user_id' => $user->id,
            'name' => $request->input('plan_name'),
        ]);

        $exerciseData = $request->validate([
            'exercise_name.*' => 'required',
            'amount.*' => 'required|integer',
            'note.*' => 'nullable|string',
        ]);

        foreach ($exerciseData['exercise_name'] as $key => $exercise) {
            $workoutPlan->exercises()->create([
                'exercise_name' => $exercise,
                'amount' => $exerciseData['amount'][$key],
                'note' => $exerciseData['note'][$key],
            ]);
        }

        return redirect()->route('workout_plans', ['username' => $user->name])
            ->with('success', 'Workout plan created successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        $workoutPlan = WorkoutPlan::findOrFail($id);

        $workoutPlan->update([
            'user_id' => $user->id,
            'name' => $request->input('plan_name'),
        ]);

        $exerciseData = $request->validate([
            'exercise_name.*' => 'required',
            'amount.*' => 'required|integer',
            'note.*' => 'nullable|string',
        ]);

        // Delete existing exercises for the workout plan
        $workoutPlan->exercises()->delete();

        foreach ($exerciseData['exercise_name'] as $key => $exercise) {
            $workoutPlan->exercises()->create([
                'exercise_name' => $exercise,
                'amount' => $exerciseData['amount'][$key],
                'note' => $exerciseData['note'][$key],
            ]);
        }

        return redirect()->route('welcome');
    }

    public function edit($id)
    {
        $workoutPlan = WorkoutPlan::findOrFail($id);
        return view('plans.edit', compact('workoutPlan'));
    }

    public function delete($id)
    {
        $user = \Auth::user();

        $workoutPlan = WorkoutPlan::findOrFail($id);
        $workoutPlan->delete();

        return redirect()->route('workout_plans', ['username' => $user->name])
            ->with('success', 'Workout plan deleted successfully.');
    }
}
