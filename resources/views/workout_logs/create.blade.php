<!-- Add form for workout logs -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Add Workout Log</h2>

        <form method="post" action="{{ route('workout_progress.store', ['assignmentId' => $assignment->id]) }}">
            @csrf
            <div class="form-group">
                <label for="exercise_id">Select Exercise:</label>
                <select class="form-control" id="exercise_id" name="exercise_id">
                    @foreach($exercises as $exercise)
                        <option value="{{ $exercise->id }}">{{ $exercise->exercise_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sets">Sets:</label>
                <input type="number" class="form-control" id="sets" name="sets" required>
            </div>
            <div class="form-group">
                <label for="note">Note:</label>
                <textarea class="form-control" id="note" name="note"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Add Log</button>
        </form>
    </div>
@endsection
