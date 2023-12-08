@extends('layouts.app')

@section('content')

<!-- Display Community Foods -->
<div class="foods-list">
    <h2>Community Foods</h2>
    @forelse($communityFoods as $food)
        <!-- Display Community Food Details -->
        {{-- Your existing code for displaying food details --}}

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

<!-- Display Official Foods -->
<div class="foods-list">
    <h2>Official Foods</h2>
    @forelse($officialFoods as $food)
        <!-- Display Official Food Details -->
        {{-- Your existing code for displaying food details --}}

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

@endsection