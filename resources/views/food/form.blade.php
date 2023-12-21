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

        <div class="food-form-section">
            <label class = "required" for="calories">Calories:</label>
            <input type="number" min="1" value="0" id="calories" name="calories" required><br>
        </div>

        <div class="food-form-section">
            <label class = "required" for="protein">Protein (grams):</label>
            <input type="number" min="0" value="0" id="protein" name="protein" required><br>
        </div>

        <div class="food-form-section">
            <label class = "required" for="carbohydrates">Carbohydrates (grams):</label>
            <input type="number" min="0" value="0" id="carbohydrates" name="carbohydrates" required><br>
        </div>

                <div class="food-form-section">
            <label class = "required" for="fat">Fats (grams):</label>
            <input type="number" min="0" value="0" id="fat" name="fat" required><br>
        </div>

        <div class="food-form-section">
            <label class = "required" for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br>
        </div>

        <div class="food-form-section">
            <label for="vegetarian_option">Vegetarian Option:</label>
            <input type="checkbox" id="vegetarian_option" name="vegetarian_option"><br>
        </div>
    
        <input type="submit" value="Submit">
    </form>
</div>

@endsection