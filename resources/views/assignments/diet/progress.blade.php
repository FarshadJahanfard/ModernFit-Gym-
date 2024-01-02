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

                @php
                    // Adjust this logic to use the filtered logs based on the selected date
                    $logsForNutrition = $logs->filter(function ($log) {
                        $date = request('filterDate') ?? date("Y-m-d");
                        return $log->pivot->created_at->format('Y-m-d') == $date;
                    });

                    $todayLogs = $logsForNutrition->filter(function ($log) {
                        $date = request('filterDate') ?? date("Y-m-d");
                        return $log->pivot->created_at->format('Y-m-d') == $date;
                    });
                @endphp

                <p>
                    <strong>Calories:</strong>
                    <span class="{{ progressColor($assignment->plan->calories, totalCalories($todayLogs)) }}">
                        {{ formattedProgress($assignment->plan->calories, totalCalories($todayLogs)) }}
                    </span>
                </p>

                <p>
                    <strong>Protein:</strong>
                    <span class="{{ progressColor($assignment->plan->protein, totalProtein($todayLogs)) }}">
                        {{ formattedProgress($assignment->plan->protein, totalProtein($todayLogs)) }}
                    </span>
                </p>

                <p>
                    <strong>Fats:</strong>
                    <span class="{{ progressColor($assignment->plan->fats, totalFats($todayLogs)) }}">
                        {{ formattedProgress($assignment->plan->fats, totalFats($todayLogs)) }}
                    </span>
                </p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h3 class="align-self-end">Diet Logs</h3>
                    <form class="d-flex gap-2" action="{{ url()->current() }}" method="GET">
                        <div class="form-group mr-2">
                            <label for="filterDate">Filter by Date:</label>
                            <input type="date" id="filterDate" name="filterDate" class="form-control" value="{{ request('filterDate') }}">
                        </div>
                        <button type="submit" class="align-self-center btn btn-primary mt-3">Apply Filter</button>
                    </form>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Food Name</th>
                        <th>Calories</th>
                        <th>Protein</th>
                        <th>Fats</th>
                        <th>Carbs</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $logsByDate = $logs->groupBy(function ($log) {
                            return $log->pivot->created_at->format('Y-m-d');
                        });
                        $sortedDates = $logsByDate->keys()->sortDesc();
                    @endphp

                    @foreach($sortedDates as $date)
                        @if(request('filterDate') && $date != request('filterDate'))
                            @continue
                        @endif

                        <tr class="table-primary">
                            <td colspan="7" class="font-weight-bold">{{ $date }}</td>
                        </tr>

                        @foreach($logsByDate[$date] as $log)
                            <tr>
                                <td></td> <!-- Empty cell for better visual separation -->
                                <td>{{ $log->name }}</td>
                                <td>{{ $log->calories }}</td>
                                <td>{{ $log->protein }}</td>
                                <td>{{ $log->fat }}</td>
                                <td>{{ $log->carbohydrates }}</td>
                                <td>{{ $log->description }}</td>
                            </tr>
                        @endforeach
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
