<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Information</title>
</head>
<body>

    {{-- @foreach($foods as $food)
    @php
    $runningTotal += $food->calories;
    @endphp
    @endforeach --}}
    {{-- @php
    $dailyCalorieCount = 2000;
    $runningTotal = 0;
    @endphp
    
    @if($runningTotal > $dailyCalorieCount)
    You have exceeded your daily calorie count.
    @else
    Remaining Calorie Allowance: {{ $dailyCalorieCount - $runningTotal }}
    @endif

<h1>Nutrition Information</h1>
<h2>Total Calorie Allowance: {{ $dailyCalorieCount }}</h2>

@if(isset($food))
    <h2>{{ $food->name }}</h2>
    <p>Quantity: {{ $food->quantity }}</p>
    <p>Calories: {{ $food->calories }}</p>
    <p>Description: {{ $food->description }}</p>
    @if($food->vegetarian)
        <p>Vegetarian Option</p>
    @endif
@else
    <p>No nutrition information available.</p>
@endif

</body>
</html> --}}

{{-- @php
    $dailyCalorieCount = 2000;
    $runningTotal = 0;
@endphp

@if(isset($food))
    @php
        // Calculate running total of calories
        $runningTotal += $food->calories;
    @endphp

    <h2>{{ $food->name }}</h2>
    <p>Quantity: {{ $food->quantity }}</p>
    <p>Calories: {{ $food->calories }}</p>
    <p>Description: {{ $food->description }}</p>
    @if($food->vegetarian)
        <p>Vegetarian Option</p>
    @endif
@else
    <p>No nutrition information available.</p>
@endif

<h1>Nutrition Information</h1>
<h2>Total Calorie Allowance: {{ $dailyCalorieCount }}</h2>

@if($runningTotal > $dailyCalorieCount)
    <p>You have exceeded your daily calorie count.</p>
@else
    <p>Remaining Calorie Allowance: {{ $dailyCalorieCount - $runningTotal }}</p>
@endif

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Information</title>
</head>
<body>

@php
    $dailyCalorieCount = 2000;
@endphp

<h1>Nutrition Information</h1>
<h2>Total Calorie Allowance: {{ $dailyCalorieCount }}</h2>
@if($dailyCalorieCount < $runningTotal)
    <h3>You have exceeded your daily calorie count!</h3>
@else
<p>Remaining Calorie Allowance: {{ $dailyCalorieCount - $runningTotal }}</p>
@endif
<h3>Testing running total: {{ $runningTotal }}</h3>

@forelse($foods as $food)
    <h2>{{ $food->name }}</h2>
    <p>Quantity: {{ $food->quantity }}</p>
    <p>Calories: {{ $food->calories }}</p>
    <p>Description: {{ $food->description }}</p>
    @if($food->vegetarian)
        <p>Vegetarian Option</p>
    @endif

    @php
        // Calculate running total of calories
        $runningTotal += $food->calories;
    @endphp

@empty
    <p>No nutrition information available.</p>
@endforelse

</body>
</html>