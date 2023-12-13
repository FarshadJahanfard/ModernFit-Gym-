@extends('layouts.app')

@section('content')

<style>
    body {
        overflow: hidden;
    }
</style>

{{-- W3schools https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_toggle_like_dislike --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<form action="{{ url('/food/form') }}" method="get">
    <button type="submit" class="view-class-btn">Create Food</button>
 </form>

<!-- Display Community Foods -->
<div class="food-split left">
    <h2>Community Foods</h2>
    <div class="foods-list">
        @forelse($communityFoods as $food)
            <div class="food-tab">
                <div class="food-tab-background">
                    <h2>{{ $food->name }}</h2>
                    <p>Quantity: {{ $food->quantity }}</p>
                    <p>Calories: {{ $food->calories }}</p>
                    <p>Protein: {{ $food->protein }}</p>
                    <p>Fats: {{ $food->fat }}</p>
                    <p>Carbohydrates: {{ $food->carbohydrates }}</p>
                    <p>Description: {{ $food->description }}</p>
                    @if($food->vegetarian)
                        <p>Vegetarian Option</p>
                    @endif
                    <!-- Other food details... -->
                    <!-- Form to add food to user's list -->
                    <form action="{{ route('addFood', ['id' => $food->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">Add to Daily Calories</button>
                    </form>
                    <div class="likes-container">
                        <!-- Like button -->
                        <form action="{{ route('likeFood', ['id' => $food->id]) }}" method="post">
                            @csrf
                            <button id="like" class="fa fa-thumbs-up btn btn-success btn-sm" type="submit"></button>
                        </form>
                        <p>Likes: {{ $food->likes }}</p>
    
                        <!-- Dislike button -->
                        <form action="{{ route('dislikeFood', ['id' => $food->id]) }}" method="post">
                            @csrf
                            <button id="dislike" class="fa fa-thumbs-down btn btn-danger btn-sm" type="submit"><div class="dislike-image"></div></button>
                        </form>
                        <p>Dislikes: {{ $food->dislikes }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>No community foods available.</p>
        @endforelse
    </div>
</div>

<style>
    body{
        background-color: rgb(36, 37, 65);
    }
    h2{
        color: white;
    }
</style>

<div class="food-split right">
    <!-- Display Official Foods -->
    <h2>Official Foods</h2>
    <div class="foods-list">
        @forelse($officialFoods as $food)
            <!-- Display Official Food Details -->
            <div class="food-tab">
                <div class="food-tab-background">
                    <h2>{{ $food->name }}</h2>
                    <p>Quantity: {{ $food->quantity }}</p>
                    <p>Calories: {{ $food->calories }}</p>
                    <p>Protein: {{ $food->protein }}</p>
                    <p>Fats: {{ $food->fat }}</p>
                    <p>Carbohydrates: {{ $food->carbohydrates }}</p>
                    <p>Description: {{ $food->description }}</p>
                    @if($food->vegetarian)
                        <p>Vegetarian Option</p>
                    @endif
                    <!-- Form to add food to user's list -->
                    <form action="{{ route('addFood', ['id' => $food->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">Add to Daily Calories</button>
                    </form>
                </div>
            </div>

        @empty
            <p>No official foods available.</p>
        @endforelse
    </div>
</div>

@endsection
