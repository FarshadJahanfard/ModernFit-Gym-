@extends('layouts.app')

@section('content')

<h1>Create Class</h1>

<div class="food-form-container">
    <form class="food-form" action="{{ url('/classes/process') }}" method="post">
        @csrf
    
        <div class="food-form-section">
            <label for="title">Class Name:</label>
            <input type="text" id="title" name="title" required><br>
        </div>

        <div class="food-form-section">
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required><br>
        </div>

        <div class="food-form-section">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required></textarea><br>
        </div>
        

        <div class="food-form-section">
            <label for="time">Time:</label>
            <input type="time" id="time" name="time"><br>
        </div>
    
        <input type="submit" value="Submit">
    </form>
</div>

@endsection