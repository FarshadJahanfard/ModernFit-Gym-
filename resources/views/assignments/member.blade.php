@extends('layouts.app')

@include('assignments.functions')

@section('content')
    <div class="container mt-4">
        <h2>Your Assignments</h2>

        <div class="row">
            <!-- Workout Assignments -->
            <div class="col-md-6">
                @if(count($workoutAssignments) > 0)
                    <h3>Workout Assignments</h3>
                    <div class="list-group mt-3">
                        @foreach($workoutAssignments as $assignment)
                            @php
                                $progressBarWidth = getProgressBarWidth($assignment);
                            @endphp
                            <div class="list-group-item">
                                <h5 class="mb-2">{{ $assignment->workoutPlan->name }}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex" style="width: 80%" y>
                                        <div style="width:90%;">
                                            @include('partials.progress-bar', ['assignment' => $assignment])
                                        </div>
                                        <span class="badge badge-primary badge-pill ml-3">{{ $progressBarWidth }}%</span>
                                    </div>
                                    <a href="{{ route('workout_assignments.progress', ['assignmentId' => $assignment->id]) }}"
                                       class="btn btn-info btn-sm">View</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>You don't have any workout assignments yet.</p>
                @endif
            </div>

            <!-- Diet Assignments -->
            <div class="col-md-6">
                @if(count($dietAssignments) > 0)
                    <h3>Diet Assignments</h3>
                    <ul class="list-group mt-3">
                        @foreach($dietAssignments as $assignment)
                            <li class="list-group-item">
                                <h5 class="mb-2">{{ $assignment->plan->name }}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    @include('assignments.diet.functions')
                                    @php
                                        $todayLogs = $foodLogs->filter(function ($log) {
                                            return $log->pivot->created_at->isToday();
                                        });
                                    @endphp
                                    @php
                                        $amount = $assignment->plan->calories;
                                        $percentage = calculateCaloriesProgress($todayLogs, $amount);
                                        $progressBarWidth = min(100, max(0, $percentage)); // Ensure progress is within valid range (0 to 100)
                                        $isRed = $percentage > 100;
                                    @endphp

                                    <div style="width:300px;">
                                        <div class="progress ml-3 mt-1">
                                            <div class="progress-bar @if($isRed) bg-danger @endif" role="progressbar" style="width: {{ $progressBarWidth }}%;" aria-valuenow="{{ $progressBarWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <span class="badge badge-primary badge-pill ml-3">{{ floor($percentage) }}%</span>
                                    <a href="{{ route('diet_assignments.progress', ['assignmentId' => $assignment->id]) }}"
                                       class="btn btn-info btn-sm">View</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>You don't have any diet assignments yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
