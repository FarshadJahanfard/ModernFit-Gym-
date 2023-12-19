<!-- diet_plans/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Diet Plan: {{ $dietPlan->name }}</h2>

        <div class="row">
            <!-- Left Column - Diet Plan Info -->
            <div class="col-md-4"> <!-- Adjusted to 40% -->
                <p><strong>Diet Plan Details:</strong></p>
                <!-- Add other diet plan details as needed -->
                <ul>
                    <li><strong>Calories:</strong> {{ $dietPlan->calories }}</li>
                    <li><strong>Protein:</strong> {{ $dietPlan->protein }}</li>
                    <li><strong>Fats:</strong> {{ $dietPlan->fats }}</li>
                    <li><strong>Note:</strong> {{ $dietPlan->note }}</li>
                </ul>
            </div>

            <!-- Right Column - Assigned Members -->
            <div class="col-md-8"> <!-- Adjusted to take the remaining 60% -->
                <p><strong>Assigned Members:</strong></p>
                @if(count($assignments) > 0)
                    <ul class="list-group">
                        @foreach($assignments as $assignment)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex">
                                    <a href="{{ route('diet_assignments.progress', ['assignmentId' => $assignment->id]) }}">
                                        {{ $assignment->user->name }}
                                    </a>
                                    @include('assignments.diet.functions')
                                    @php
                                        $amount = $assignment->plan->calories;
                                        $percentage = calculateCaloriesProgress($logs, $amount);
                                        $progressBarWidth = min(100, max(0, $percentage)); // Ensure progress is within valid range (0 to 100)
                                        $isRed = $percentage > 100;
                                    @endphp

                                    <div style="width:300px;">
                                        <div class="progress ml-3 mt-1">
                                            <div class="progress-bar @if($isRed) bg-danger @endif" role="progressbar" style="width: {{ $progressBarWidth }}%;" aria-valuenow="{{ $progressBarWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <span class="badge badge-primary badge-pill ml-3">{{ floor($percentage) }}%</span>
                                </div>
                                <div class="float-right">
                                    <button class="btn btn-info btn-sm" onclick="location.href='{{ route('diet_assignments.progress', ['assignmentId' => $assignment->id]) }}'">View Progress</button>

                                    <!-- Trigger the Edit Assignment Modal -->
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAssignModal{{ $assignment->id }}">Edit</button>

                                    <form action="{{ route('diet_assignments.destroy', ['diet_assignment' => $assignment->id]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this assigned member?')">Delete</button>
                                    </form>
                                </div>
                            </li>

                            <!-- Edit Assignment Modal -->
                            <div class="modal fade" id="editAssignModal{{ $assignment->id }}" tabindex="-1" role="dialog" aria-labelledby="editAssignModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAssignModalLabel">Edit Diet Assignment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Edit form for diet assignment -->
                                            <form method="post" action="{{ route('diet_assignments.update', ['diet_assignment' => $assignment->id]) }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="start_date">Start Date:</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $assignment->start_date }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="end_date">End Date:</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $assignment->end_date }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="note">Note:</label>
                                                    <textarea class="form-control" id="note" name="note">{{ $assignment->note }}</textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Update Assignment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <p>No members assigned to this plan yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
