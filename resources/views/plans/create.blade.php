<!-- resources/views/workout_plans/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('workout_plans.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="plan_name" class="form-label">Workout Plan Name</label>
                <input type="text" name="plan_name" class="form-control" required>
            </div>

            <div id="exercise-inputs">
                <div class="row exercise-group mb-3">
                    <div class="col-md-3">
                        <label for="exercise_name" class="form-label">Exercise Name</label>
                        <input type="text" name="exercise_name[]" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount[]" class="form-control" required>
                    </div>
                    <div class="col-md-5">
                        <label for="note" class="form-label">Note</label>
                        <input type="text" name="note[]" class="form-control">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger mt-auto remove-exercise">Remove</button>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-success mr-2" id="add-exercise">Add Exercise</button>
                <button type="submit" class="btn btn-primary">Create Workout Plan</button>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/exercise-management.js') }}"></script>
@endsection
