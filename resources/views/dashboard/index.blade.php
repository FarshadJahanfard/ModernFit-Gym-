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
            @if ($classes->isEmpty())
                <p>You are not signed up for any classes.</p>
            @else
                <h2>Your classes:</h2>
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
            @if ($classes->isEmpty())
                <p>You dont have any plans assigned.</p>
            @else
                <h2>Your Plan Progress:</h2>
                <div class="food-list">
                    @foreach ($classes as $class)
                        <div class="food-tab">
                            {{-- Will need to put progress bars here --}}
                            {{-- <h2>{{ $class->title }}</h2>
                            <p>Quantity: {{ $class->date }}</p>
                            <p>Calories: {{ $class->time }}</p>
                            <p>Description: {{ $class->description }}</p>
                            <form action="{{ route('removeClass', ['id' => $class->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form> --}}
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    </div>

    <script>
        function toggleDetails(mealId) {
            const details = document.getElementById('details-' + mealId);
            details.style.display = details.style.display === 'none' ? 'block' : 'none';
        }
    </script>

@endsection
