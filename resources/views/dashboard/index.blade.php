@extends('layouts.app')

@section('content')

<h1>Welcome to Your Dashboard, {{ auth()->user()->name }}!</h1>

<h2>Your Meals for Today</h2>

@if($meals->isEmpty())
    <p>No meals recorded for today.</p>
@else
    <ul>
        @foreach($meals as $meal)
            <li>{{ $meal->name }} - {{ $meal->calories }} calories</li>
        @endforeach
    </ul>

    <p>Total Calories for Today: {{ $totalCalories }}</p>
@endif

@endsection