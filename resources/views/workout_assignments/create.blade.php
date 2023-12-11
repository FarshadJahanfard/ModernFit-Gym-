<!-- Add form for workout assignment -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Assign Workout Plan</h2>

        <form method="post" action="{{ route('workout_assignments.store') }}">
            @csrf
            <input type="hidden" name="plan_id" value="{{ $workoutPlan->id }}">
            <div class="form-group">
                <label for="members">Select Members:</label>
                <select multiple class="form-control" id="members" name="members[]">
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Assign Plan</button>
        </form>
    </div>
@endsection
