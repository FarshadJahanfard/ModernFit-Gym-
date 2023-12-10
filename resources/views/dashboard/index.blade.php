@extends('layouts.app')

@section('content')

<style>
    body {
        overflow: hidden;
    }
    .foods-list{
        height: 85%;
        width: 40rem;
        border-radius: 40px;
    }
</style>

<h1>Welcome to Your Dashboard, {{ auth()->user()->name }}!</h1>

<form action="{{ route('detach-foods') }}" method="post">
    @csrf
    <button type="submit">Detach Foods</button>
    <p>This button is here for demonstration purposes only...</p>
</form>

@if($meals->isEmpty())
    <p>No meals recorded for today.</p>
@else
<p>Total Calories for Today: {{ $totalCalories }}</p>

<div class="dashboard-container">
    <div class="food-split left">
        <h2>Todays Meals:</h2>
        <div class="foods-list">
        @foreach($meals as $meal)
    
        <div class="food-tab">
            <h2>{{$meal->name}}</h2>
            <p>Quantity: {{ $meal->quantity }}</p>
            <p>Calories: {{ $meal->calories }}</p>
            <p>Description: {{ $meal->description }}</p>
            @if($meal->vegetarian)
            <p>Vegetarian Option</p>
            @endif
            <form action="{{ route('removeFood', ['id' => $meal->id]) }}" method="post">
                @csrf
                <button type="submit">Remove</button>
            </form>
        </div>
        @endforeach
    </div>
</div>

@endif

@endsection