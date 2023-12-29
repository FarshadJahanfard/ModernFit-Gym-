@extends('layouts.app')

@section('content')

    <style>
        /* These classes have to be inline to override the main stylesheet */
        main {
            padding-top: 0px;
        }

        body{
            overflow: hidden;
        }

        .filter{
            background-color: rgb(219, 127, 7);
            color: #fff;
            border-color: white;
            border-radius: 8px;
            font-weight: bold;
            margin: .5rem;
            margin-left: 0;
        }
    </style>

    <div class="dashboard-top">
        <h1>Welcome to Your Dashboard, {{ auth()->user()->name }}!</h1>
        <p>Total Calories for Today: {{ $totalCalories }}</p>
    </div>

    <div class="dashboard-container">
        <div class="dashboard-section meals">
            <h2>Your Meals:</h2>
            <form action="{{ route('dashboard') }}" method="get">
                @csrf
                <label for="date">Select Date:</label>
                <input type="date" name="date" id="date" value="{{ request('date', now()->format('Y-m-d')) }}">
                <button type="submit" class="btn btn-danger filter">Filter</button>
            </form>

            @if ($meals->isEmpty())
                <p>No meals recorded for today.</p>
            @else
                <div class="food-list">
                    @foreach ($meals as $meal)
                        <div class="food-tab">
                            <div class="food-tab-background">
                                <h2>{{ $meal->name }}</h2>
                                <!-- Display essential information -->
                                {{-- <p>Quantity: {{ $meal->quantity }}</p> --}}
                                <p>Description: {{ $meal->description }}</p>
                                <!-- View More Button -->
                                <p class="view-more-btn" onclick="toggleDetails({{ $meal->id }})">View More</p>
                                <!-- Expanded Details (initially hidden) -->
                                <div class="food-details" id="details-{{ $meal->id }}">
                                    <p>Calories: {{ $meal->calories }}</p>
                                    <p>Protein: {{ $meal->protein }}</p>
                                    <p>Fats: {{ $meal->fat }}</p>
                                    <p>Carbohydrates: {{ $meal->carbohydrates }}</p>
                                    @if ($meal->vegetarian)
                                        <p>Vegetarian Option</p>
                                    @endif
                                    <form action="{{ route('removeFood', ['id' => $meal->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm remove">Remove</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="dashboard-section classes">
            <h2>Your classes:</h2>
            @if ($classes->isEmpty())
                <p>You are not signed up for any classes.</p>
            @else
                <div class="dashboard-class-list">
                    @foreach ($classes as $class)
                        <div class="food-tab">
                            <h2>{{ $class->title }}</h2>
                            <p>Date: {{ $class->date }}</p>
                            <p>Time: {{ $class->time }}</p>
                            <p>Description: {{ $class->description }}</p>
                            <form action="{{ route('removeClass', ['id' => $class->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Unregister</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="dashboard-section classes">
            @if (count($workoutAssignments) === 0 && count($dietAssignments) === 0)
                <p>You dont have any plans assigned.</p>
            @else
                <div class="food-list" style="overflow-x: hidden;">
                    <div class="row">
                        <!-- Combined Assignments -->
                        <div class="col-md-12">
                            <!-- Workout Assignments -->
                            @include('assignments.functions')
                            @if(count($workoutAssignments) > 0)
                                <h3>Workout Plans Progress</h3>
                                <div class="list-group mt-3">
                                    @foreach($workoutAssignments as $assignment)
                                        @php
                                            $progressBarWidth = getProgressBarWidth($assignment);
                                        @endphp
                                        <div class="list-group-item">
                                            <h5 class="mb-2">{{ $assignment->workoutPlan->name }}</h5>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex" style="width: 80%">
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
                                <p></p>
                            @endif

                            <!-- Diet Assignments -->
                            @if(count($dietAssignments) > 0)
                                <h3 class="mt-2">Diet Plans Progress</h3>
                                <ul class="list-group mt-3">
                                    @foreach($dietAssignments as $assignment)
                                        <li class="list-group-item">
                                            <h5 class="mb-2">{{ $assignment->plan->name }}</h5>
                                            <div class="d-flex justify-content-between align-items-center">
                                                @php
                                                    $todayLogs = $foodLogs->filter(function ($log) {
                                                        return $log->pivot->created_at->isToday();
                                                    });
                                                @endphp
                                                @php
                                                    $amount = $assignment->plan->calories;
                                                    $totalAmount = $todayLogs->sum('calories');
                                                    $percentage = ($totalAmount / $amount) * 100;
                                                    $progressBarWidth = min(100, max(0, $percentage)); // Ensure progress is within valid range (0 to 100)
                                                    $isRed = $percentage > 100;
                                                @endphp

                                                <div class="d-flex" style="width:80%">
                                                    <div style="width:90%;">
                                                        <div class="progress ml-3 mt-1">
                                                            <div class="progress-bar @if($isRed) bg-danger @endif" role="progressbar" style="width: {{ $progressBarWidth }}%;" aria-valuenow="{{ $progressBarWidth }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <span class="badge badge-primary badge-pill ml-3">{{ floor($percentage) }}%</span>
                                                </div>
                                                <a href="{{ route('diet_assignments.progress', ['assignmentId' => $assignment->id]) }}"
                                                   class="btn btn-info btn-sm">View</a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p></p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleDetails(mealId) {
            const details = document.getElementById('details-' + mealId);
            details.style.display = details.style.display === 'none' ? 'block' : 'none';
        }
    </script>

@endsection
