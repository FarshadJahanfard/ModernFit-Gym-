@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Left Column - Workout Plans -->
            <div class="col-md-6">
                <h2>Your Workout Plans</h2>
                <a href="{{ route('workout_plans.create') }}" class="btn btn-success mb-3">Add Workout Plan</a>

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

            <!-- Right Column - Diet Plans -->
            <div class="col-md-6">
                <h2>Your Diet Plans</h2>
                <a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#addDietPlanModal">Add Diet Plan</a>

                @if($dietPlans && count($dietPlans) > 0)
                    <ul class="list-group mt-3">
                        @foreach($dietPlans as $dietPlan)
                            <li class="list-group-item">
                                {{ $dietPlan->name }}
                                <div class="float-right">
                                    <a href="{{ route('diet_plans.show', ['id' => $dietPlan->id]) }}" class="btn btn-info btn-sm">View</a>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $dietPlan->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('diet_plans.destroy', ['id' => $dietPlan->id]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</button>
                                    </form>
                                    <!-- Button to open modal -->
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#assignModal{{ $dietPlan->id }}">
                                        Assign
                                    </button>
                                </div>
                            </li>

                            <div class="modal fade" id="editModal{{ $dietPlan->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Diet Plan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Add your form for editing diet plan here -->
                                            <form method="post" action="{{ route('diet_plans.update', ['id' => $dietPlan->id]) }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="diet_name">Diet Name:</label>
                                                    <input type="text" class="form-control" id="diet_name" name="diet_name" value="{{ $dietPlan->name }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="calories">Calories:</label>
                                                    <input type="number" class="form-control" id="calories" name="calories" value="{{ $dietPlan->calories }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="protein">Protein:</label>
                                                    <input type="number" class="form-control" id="protein" name="protein" value="{{ $dietPlan->protein }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="fats">Fats:</label>
                                                    <input type="number" class="form-control" id="fats" name="fats" value="{{ $dietPlan->fats }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="note">Note:</label>
                                                    <textarea class="form-control" id="note" name="note">{{ $dietPlan->note }}</textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Update Diet Plan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for assigning diet plan -->
                            <div class="modal fade" id="assignModal{{ $dietPlan->id }}" tabindex="-1" role="dialog" aria-labelledby="assignModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="assignModalLabel">Assign Diet Plan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Add your form for diet assignment here -->
                                            <form method="post" action="{{ route('diet_assignments.store') }}">
                                                @csrf
                                                <input type="hidden" name="plan_id" value="{{ $dietPlan->id }}">

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
                    <p>You don't have any diet plans yet.</p>
                @endif

                <div class="modal fade" id="addDietPlanModal" tabindex="-1" role="dialog" aria-labelledby="addDietPlanModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addDietPlanModalLabel">Add Diet Plan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form for adding a new diet plan -->
                                <form method="post" action="{{ route('diet_plans.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="diet_name">Diet Plan Name:</label>
                                        <input type="text" class="form-control" id="diet_name" name="diet_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="calories">Calories:</label>
                                        <input type="number" class="form-control" id="calories" name="calories" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="protein">Protein (g):</label>
                                        <input type="number" class="form-control" id="protein" name="protein" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="fats">Fats (g):</label>
                                        <input type="number" class="form-control" id="fats" name="fats" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="note">Note:</label>
                                        <textarea class="form-control" id="note" name="note"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-success">Add Diet Plan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding a new diet plan -->
    <div class="modal fade" id="addDietPlanModal" tabindex="-1" role="dialog" aria-labelledby="addDietPlanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDietPlanModalLabel">Add Diet Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding a new diet plan -->
                    <form method="post" action="{{ route('diet_plans.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">Diet Plan Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <!-- Add other fields for the diet plan (calories, protein, fats, etc.) -->
                        </div>

                        <button type="submit" class="btn btn-success">Add Diet Plan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
