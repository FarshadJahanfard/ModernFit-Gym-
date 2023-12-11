<!-- workout_plans/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Workout Plan: {{ $workoutPlan->name }}</h2>

        <p><strong>Assigned Members:</strong></p>
        @if(count($assignedMembers) > 0)
            <ul>
                @foreach($assignedMembers as $member)
                    <li>
                        <a href="{{ route('workout_assignments.progress', ['assignmentId' => $member->pivot->id]) }}">
                            {{ $member->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No members assigned to this plan yet.</p>
        @endif
    </div>
@endsection
