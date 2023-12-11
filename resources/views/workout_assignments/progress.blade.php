<!-- resources/views/workout_assignments/progress.blade.php -->

@extends('layouts.app')

@include('workout_assignments.functions')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Left part - Workout Exercises -->
            <div class="col-md-6">
                <h3>Workout Plan Details</h3>
                <p><strong>Start Date:</strong> {{ $assignment->start_date }}</p>
                <p><strong>End Date:</strong> {{ $assignment->end_date }}</p>
                <p><strong>Note:</strong> {{ $assignment->note }}</p>

                @role("trainer")
                <div class="d-flex justify-content-end align-items-center mt-3">
                    <button class="btn btn-warning btn-sm mr-2" onclick="location.href='{{ route('workout_plans.edit', ['id' => $assignment->workoutPlan->id]) }}'">Edit</button>
                    <form action="{{ route('workout_plans.destroy', ['id' => $assignment->workoutPlan->id]) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this workout plan?')">Delete</button>
                    </form>
                </div>
                @endrole
                @role("admin")
                <div class="d-flex justify-content-end align-items-center mt-3">
                    <button class="btn btn-warning btn-sm mr-2" onclick="location.href='{{ route('workout_plans.edit', ['id' => $assignment->workoutPlan->id]) }}'">Edit</button>
                    <form action="{{ route('workout_plans.destroy', ['id' => $assignment->workoutPlan->id]) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this workout plan?')">Delete</button>
                    </form>
                </div>
                @endrole

                <h3>Workout Exercises</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Exercise Name</th>
                        <th>Done</th>
                        <th>Amount</th>
                        <th>Note</th>
                        <th>Progress</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($assignment->workoutPlan->exercises as $exercise)
                        @php
                            $amount = calculateAmountDone($logs, $exercise->id, $exercise->amount);
                            $progress = calculateProgress($logs, $exercise->id, $exercise->amount);
                            $progressClass = $progress >= 100 ? 'progress-complete' : '';
                        @endphp
                        <tr>
                            <td>{{ $exercise->exercise_name }}</td>
                            <td>
                                <div class="amount-done-container">
                                    <form class="amount-done-form d-flex flex-gap" method="post" action="{{ route('workout_logs.store', ['assignmentId' => $assignment->id]) }}">
                                        @csrf
                                        <input type="hidden" name="exercise_id" value="{{ $exercise->id }}">
                                        <input type="number" class="form-control amount-done-input" name="sets" value="{{ $amount }}" min="0" step="1">
                                        <button type="submit" class="btn btn-success btn-sm submit-amount-done d-none">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>{{ $exercise->amount }}</td>
                            <td>{{ $exercise->note }}</td>
                            <td class="{{ $progressClass }}">
                                {{ $progress }}%
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <style>
                    .progress-complete {
                        background-color: #4CAF50; /* Green background */
                        color: white; /* White text */
                    }
                </style>
            </div>

            <!-- Right part - Workout Logs -->
            <div class="col-md-6">
                <h3>Workout Logs</h3>

                <form action="{{ route('workout_logs.store', ['assignmentId' => $assignment->id]) }}" method="post">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="exercise_id" class="form-label">Select Exercise</label>
                            <select class="form-select" id="exercise_id" name="exercise_id" required>
                                @foreach($assignment->workoutPlan->exercises as $exercise)
                                    <option value="{{ $exercise->id }}">{{ $exercise->exercise_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="sets" class="form-label">Sets</label>
                            <input type="number" class="form-control" id="sets" name="sets" min="0" step="1" required>
                        </div>
                        <div class="col-md-5">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" id="note" name="note"></textarea>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Add Log</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Exercise Name</th>
                        <th>Sets</th>
                        <th>Note</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->exercise->exercise_name }}</td>
                            <td>{{ $log->sets }}</td>
                            <td>{{ $log->note }}</td>
                            <td>{{ $log->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('workout_logs.destroy', ['id' => $log->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this log?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const amountDoneContainers = document.querySelectorAll('.amount-done-container');

            amountDoneContainers.forEach(container => {
                const form = container.querySelector('form');
                const input = form.querySelector('.amount-done-input');
                const submitBtn = form.querySelector('.submit-amount-done');
                const initialValue = parseFloat(input.value); // Parse initial value as a number

                // Show the form with the value set to the one on the span
                form.classList.remove('d-none');

                // Check if the value in the input changes
                input.addEventListener('input', () => {
                    // Show the submit button only if there's a change
                    submitBtn.classList.remove('d-none');
                });

                form.addEventListener('submit', (event) => {
                    event.preventDefault();

                    // Calculate the difference between the new value and the initial value
                    const newValue = parseFloat(input.value);
                    const difference = newValue - initialValue;

                    // Validate that the new value is greater than the previous one
                    if (difference <= 0) {
                        alert("New value must be greater than the previous one.");
                        return; // Stop form submission
                    }

                    // Set input value to the difference
                    input.value = difference;

                    // Submit form
                    form.submit();

                    // Roll back page view
                    input.value = newValue;
                    form.classList.add('d-none');
                    submitBtn.classList.add('d-none')
                });
            });
        });
    </script>
@endsection

