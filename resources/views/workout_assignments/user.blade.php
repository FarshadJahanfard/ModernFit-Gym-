@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Your Workout Assignments</h2>

        @if(count($assignments) > 0)
            <ul class="list-group mt-3">
                @foreach($assignments as $assignment)
                    <li class="list-group-item">
                        {{ $assignment->workoutPlan->name }}
                        <div class="float-right">
                            <a href="{{ route('workout_assignments.progress', ['assignmentId' => $assignment->id]) }}" class="btn btn-info btn-sm">View</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>You don't have any workout assignments yet.</p>
        @endif
    </div>
@endsection
