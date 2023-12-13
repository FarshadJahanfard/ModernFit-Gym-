@extends('layouts.app')

@section('content')

<style>
    body {
        /* overflow: hidden; */
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
    <button type="submit" class="btn btn-danger btn-sm">Detach Foods</button>
    <p>This button is here for demonstration purposes only...</p>
</form>

<p>Total Calories for Today: {{ $totalCalories }}</p>

<div class="dashboard-container">

    <div class="food-split left">

        @if($meals->isEmpty())
            <p>No meals recorded for today.</p>
        @else

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
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
            </div>
            @endforeach
        </div>
        @endif
    </div>


    <div class="food-split right">

        @if($classes->isEmpty())
        <p>You are not signed up for any classes.</p>
        @else

        <h2>Your classes:</h2>
        <div class="foods-list">
            @foreach($classes as $class)

            <div class="food-tab">
                <h2>{{$class->title}}</h2>
                <p>Quantity: {{ $class->date }}</p>
                <p>Calories: {{ $class->time }}</p>
                <p>Description: {{ $class->description }}</p>
                <form action="{{ route('removeClass', ['id' => $class->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>


@endsection
