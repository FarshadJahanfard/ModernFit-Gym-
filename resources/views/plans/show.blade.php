<!-- workout_plans/show.blade.php -->

@extends('layouts.app')

@include('workout_assignments.functions')

@section('content')
    <div class="container mt-4">
        <h2>Workout Plan: {{ $workoutPlan->name }}</h2>

        <div class="row">
            <!-- Left Column - Workout Plan Info -->
            <div class="col-md-4"> <!-- Adjusted to 40% -->
                <p><strong>Workout Plan Details:</strong></p>
                <!-- Add other workout plan details as needed -->
                <ul>
                    @foreach($workoutPlan->exercises as $exercise)
                        <li>{{ $exercise->exercise_name }} - Amount: {{ $exercise->amount }} - Note: {{ $exercise->note }}</li>
                    @endforeach
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
                                    <a href="{{ route('workout_assignments.progress', ['assignmentId' => $assignment->id]) }}">
                                        {{ $assignment->member->name }}
                                    </a>
                                    <div style="width:300px;">
                                        @include('partials.progress-bar', ['assignment' => $assignment])
                                    </div>
                                </div>
                                <div class="float-right">
                                    <button class="btn btn-info btn-sm" onclick="location.href='{{ route('workout_assignments.progress', ['assignmentId' => $assignment->id]) }}'">View Progress</button>

                                    <!-- Trigger the Edit Assignment Modal -->
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAssignModal{{ $assignment->id }}">Edit</button>

                                    <form action="{{ route('workout_assignments.destroy', ['workout_assignment' => $assignment->id]) }}" method="post" class="d-inline">
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
                                            <h5 class="modal-title" id="editAssignModalLabel">Edit Workout Assignment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Edit form for workout assignment -->
                                            <form method="post" action="{{ route('workout_assignments.update', ['workout_assignment' => $assignment->id]) }}">
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
