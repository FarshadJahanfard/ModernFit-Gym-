@extends('layouts.app')

@section('content')

<h1>Create Class</h1>

<div class="food-form-container">
    <form class="food-form" action="{{ url('/classes/process') }}" method="post">
        @csrf
    
        <div class="food-form-section">
            <label for="name">Class Name:</label>
            <input type="text" id="name" name="name" required><br>
        </div>

        <div class="food-form-section">
            <label for="calories">Description:</label>
            <input type="text" id="calories" name="calories" required><br>
        </div>

        <div class="food-form-section">
            <label for="description">Date:</label>
            <input type="date" id="description" name="description" required></textarea><br>
        </div>

        <div class="food-form-section">
            <label for="vegetarian_option">Time:</label>
            <input type="time" id="vegetarian_option" name="vegetarian_option"><br>
        </div>
    
        <input type="submit" value="Submit">
    </form>
</div>

@endsection