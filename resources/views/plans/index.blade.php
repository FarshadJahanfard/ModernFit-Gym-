@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Your Workout Plans</h2>

        <a href="{{ route('workout_plans.create') }}" class="btn btn-success mb-3">Add Plan</a>

        @if(count($workoutPlans) > 0)
            <ul class="list-group mt-3">
                @foreach($workoutPlans as $workoutPlan)
                    <li class="list-group-item">
                        {{ $workoutPlan->name }}
                        <div class="float-right">
                            <a href="{{ route('workout_plans.show', ['id' => $workoutPlan->id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('workout_plans.edit', ['id' => $workoutPlan->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('workout_plans.destroy', ['id' => $workoutPlan->id]) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</button>
                            </form>
                            <!-- Button to open modal -->
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#assignModal{{ $workoutPlan->id }}">
                                Assign
                            </button>
                        </div>
                    </li>

                    <!-- Modal for assigning workout plan -->
                    <div class="modal fade" id="assignModal{{ $workoutPlan->id }}" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="assignModalLabel">Assign Workout Plan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add your form for workout assignment here -->
                                    <form method="post" action="{{ route('workout_assignments.store') }}">
                                        @csrf
                                        <input type="hidden" name="plan_id" value="{{ $workoutPlan->id }}">

                                        <div class="form-group">
                                            <label for="username">Member's Username:</label>
                                            <input type="text" class="form-control" id="username" name="username" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="end_date">End Date:</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="note">Note:</label>
                                            <textarea class="form-control" id="note" name="note"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-success">Assign Plan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </ul>
        @else
            <p>You don't have any workout plans yet.</p>
        @endif
    </div>
@endsection
