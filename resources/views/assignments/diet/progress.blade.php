<!-- resources/views/assignments/diet/progress.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Diet Assignment Progress</h2>

        <div class="row">
            <div class="col-md-6">
                <h3>Diet Plan Details</h3>
                <p><strong>Start Date:</strong> {{ $assignment->start_date }}</p>
                <p><strong>End Date:</strong> {{ $assignment->end_date }}</p>
                <p><strong>Note:</strong> {{ $assignment->note }}</p>
            </div>

            <div class="col-md-6">
                <h3>Diet Plan Nutritional Information</h3>
                <p>
                    <strong>Calories:</strong>
                    <span class="{{ progressColor($assignment->plan->calories, totalCalories($logs)) }}">
                        {{ formattedProgress($assignment->plan->calories, totalCalories($logs)) }}
                    </span>
                </p>
                <p>
                    <strong>Protein:</strong>
                    <span class="{{ progressColor($assignment->plan->protein, totalProtein($logs)) }}">
                        {{ formattedProgress($assignment->plan->protein, totalProtein($logs)) }}
                    </span>
                </p>
                <p>
                    <strong>Fats:</strong>
                    <span class="{{ progressColor($assignment->plan->fats, totalFats($logs)) }}">
                        {{ formattedProgress($assignment->plan->fats, totalFats($logs)) }}
                    </span>
                </p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Diet Logs</h3>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Calories</th>
                        <th>Protein</th>
                        <th>Fats</th>
                        <th>Carbs</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->name }}</td>
                            <td>{{ $log->calories }}</td>
                            <td>{{ $log->protein }}</td>
                            <td>{{ $log->fat }}</td>
                            <td>{{ $log->carbohydrates }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@php
    function totalCalories($logs) {
        return $logs->sum('calories');
    }

    function totalProtein($logs) {
        return $logs->sum('protein');
    }

    function totalFats($logs) {
        return $logs->sum('fat');
    }

    function formattedProgress($goal, $current) {
        return $current . '/' . $goal;
    }

    function progressColor($goal, $current) {
        return ($current >= $goal) ? 'text-danger' : '';
    }
@endphp
