<!-- Display workout progress for members -->
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Your Workout Progress</h2>

        @if(count($assignments) > 0)
            <ul class="list-group mt-3">
                @foreach($assignments as $assignment)
                    <li class="list-group-item">
                        <strong>{{ $assignment->workoutPlan->name }}</strong>
                        <div class="float-right">
                            <a href="{{ route('workout_progress.create', ['assignmentId' => $assignment->id]) }}" class="btn btn-success btn-sm">Add Log</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No assigned workout plans found.</p>
        @endif
    </div>
@endsection
