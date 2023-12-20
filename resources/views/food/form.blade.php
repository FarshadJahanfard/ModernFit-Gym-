@extends('layouts.app')

@section('content')

<h1>Create Community food</h1>

<div class="food-form-container">
    <form class="food-form" action="{{ url('/food/process') }}" method="post">
        @csrf
    
        <div class="food-form-section">
            <label class = "required" for="name">Food Name:</label>
            <input type="text" id="name" name="name" required><br>
        </div>
    
        {{-- <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br> --}}

        <div class="food-form-section">
            <label class = "required" for="calories">Calories:</label>
            <input type="number" min="1" value="100" id="calories" name="calories" required><br>
        </div>

        <div class="food-form-section">
            <label class = "required" for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br>
        </div>

        <div class="food-form-section">
            <label for="vegetarian_option">Vegetarian Option:</label>
            <input type="checkbox" id="vegetarian_option" name="vegetarian_option"><br>
        </div>
    
        {{-- <label for="official_option">Official Option:</label>
        <input type="checkbox" id="official_option" name="official_option"><br> --}}
    
        <input type="submit" value="Submit">
    </form>
</div>

@endsection