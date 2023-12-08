@extends('layouts.app')

@section('content')

<style>
    body {
        overflow: hidden;
    }
</style>

<div class="food-split left">
    <!-- Display Community Foods -->
    <h2>Community Foods</h2>
    <div class="foods-list">
        @forelse($communityFoods as $food)
            <!-- Display Community Food Details -->
                <div class="food-tab">
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
                </div>
    
        @empty
            <p>No community foods available.</p>
        @endforelse
    </div>
</div>

<div class="food-split right">
    <!-- Display Official Foods -->
    <h2>Official Foods</h2>
    <div class="foods-list">
        @forelse($officialFoods as $food)
            <!-- Display Official Food Details -->   
            <div class="food-tab">
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
            </div>
    
        @empty
            <p>No official foods available.</p>
        @endforelse
    </div>
</div>

@endsection