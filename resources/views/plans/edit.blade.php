<!-- resources/views/workout_plans/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('workout_plans.update', ['id' => $workoutPlan->id]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="plan_name" class="form-label">Workout Plan Name</label>
                <input type="text" name="plan_name" class="form-control" value="{{ $workoutPlan->name }}" required>
            </div>

            <div id="exercise-inputs">
                @foreach($workoutPlan->exercises as $exercise)
                    <div class="row exercise-group mb-3">
                        <div class="col-md-3">
                            <label for="exercise_name" class="form-label">Exercise Name</label>
                            <input type="text" name="exercise_name[]" class="form-control" value="{{ $exercise->exercise_name }}" required>
                        </div>
                        <div class="col-md-2">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount[]" class="form-control" value="{{ $exercise->amount }}" required>
                        </div>
                        <div class="col-md-5">
                            <label for="note" class="form-label">Note</label>
                            <input type="text" name="note[]" class="form-control" value="{{ $exercise->note }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger mt-auto remove-exercise">Remove</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-success mr-2" id="add-exercise">Add Exercise</button>
            <button type="submit" class="btn btn-primary">Update Workout Plan</button>
        </form>
    </div>

    <script src="{{ asset('js/exercise-management.js') }}"></script>
@endsection
