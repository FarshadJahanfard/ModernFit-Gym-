@extends('layouts.app')

@include('workout_assignments.functions')

@section('content')
    <div class="container mt-4">
        <h2>Your Workout Assignments</h2>

        @if(count($assignments) > 0)
            <ul class="list-group mt-3">
                @foreach($assignments as $assignment)
                    @php
                    $progressBarWidth = getProgressBarWidth($assignment);
                    @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $assignment->workoutPlan->name }}</span>
                        <div class="progress" style="width: 60%;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $progressBarWidth }}%;" aria-valuenow="{{ $progressBarWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="badge badge-primary badge-pill">{{ $progressBarWidth }}%</span>
                        <a href="{{ route('workout_assignments.progress', ['assignmentId' => $assignment->id]) }}" class="btn btn-info btn-sm">View</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>You don't have any workout assignments yet.</p>
        @endif
    </div>
@endsection