@extends('layouts.app')

@section('content')

{{-- @php
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
        <div class="food-tab">
            <h2>{{ $food->name }}</h2>
            <p>Quantity: {{ $food->quantity }}</p>
            <p>Calories: {{ $food->calories }}</p>
            <p>Description: {{ $food->description }}</p>
            @if($food->vegetarian)
                <p>Vegetarian Option</p>
            @endif
        </div>

    @php
        // Calculate running total of calories
        $runningTotal += $food->calories;
    @endphp

@empty
    <p>No nutrition information available.</p>
@endforelse --}}

@php
    $dailyCalorieCount = 2000;
@endphp

<h1>Nutrition Information</h1>
<h2>Total Calorie Allowance: {{ $dailyCalorieCount }}</h2>

@forelse($foods as $food)
    <h2>{{ $food->name }}</h2>
    <p>Quantity: {{ $food->quantity }}</p>
    <p>Calories: {{ $food->calories }}</p>
    <p>Description: {{ $food->description }}</p>
    @if($food->vegetarian)
        <p>Vegetarian Option</p>
    @endif

    <!-- Form to add food to user's list -->
    <form action="{{ route('addFood', ['id' => $food->id]) }}" method="post">
        @csrf
        <button type="submit">Add to Daily Calories</button>
    </form>

@empty
    <p>No nutrition information available.</p>
@endforelse

@if($runningTotal > $dailyCalorieCount)
    <p>You have exceeded your daily calorie count.</p>
@else
    <p>Remaining Calorie Allowance: {{ $dailyCalorieCount - $runningTotal }}</p>
@endif

@endsection