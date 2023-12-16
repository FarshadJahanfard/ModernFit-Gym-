@extends('layouts.app')

@section('content')
    <style>

        /* Left these styles here for now while it gets styled */

        body {
            overflow: hidden;
        }

        h2 {
            text-align: center;
            /* text-shadow: 2px 2px #121111; */
            text-transform: uppercase;
        }

        .food-container{
            display:flex;
            /* background-color: white; */
        }

        .nutrition-section{
            background-color: white;
            margin: 1rem;
            padding: 2rem;
            border-radius: 16px;
            height: 650px;
            width: 50%;
            height: 620px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
        }

        .food-list{
            height: 100%;
        }

        .nutrition-top{
            background-color: white;
            z-index: 1;
            margin: 1rem;
            margin-bottom: 0px;
            border-radius: 16px;
            padding: 1rem;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
        }
    </style>

    {{-- W3schools https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_toggle_like_dislike --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <div class="nutrition-top">
        <h1>Nutritional Information</h1>
        <form action="{{ url('/food/form') }}" method="get">
            <button type="submit" class="btn btn-success">Create Food</button>
        </form>
    </div>

    <div class="food-container">
        <div class="nutrition-section">
            <div class="food-list">
                <h2>Community Foods</h2>
                <p>Foods in this section are community made foods made by other users. If you do not see a food item on here you could always add to this list.</p>
                @forelse($communityFoods as $food)
                    <div class="food-tab">
                        <h2>{{ $food->name }}</h2>
                        {{-- <p>Quantity: {{ $food->quantity }}</p> --}}
                        <p>Calories: {{ $food->calories }}</p>
                        <p>Protein: {{ $food->protein }}</p>
                        <p>Fats: {{ $food->fat }}</p>
                        <p>Carbohydrates: {{ $food->carbohydrates }}</p>
                        <p>Description: {{ $food->description }}</p>
                        @if ($food->vegetarian)
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
                                <button id="like" class="fa fa-thumbs-up btn btn-success btn-sm"
                                    type="submit"></button>
                            </form>
                            <p>Likes: {{ $food->likes }}</p>

                            <!-- Dislike button -->
                            <form action="{{ route('dislikeFood', ['id' => $food->id]) }}" method="post">
                                @csrf
                                <button id="dislike" class="fa fa-thumbs-down btn btn-danger btn-sm" type="submit">
                                    <div class="dislike-image"></div>
                                </button>
                            </form>
                            <p>Dislikes: {{ $food->dislikes }}</p>
                        </div>
                    </div>
                @empty
                    <p>No community foods available.</p>
                @endforelse
            </div>
        </div>

        <div class="nutrition-section">
            <div class="food-list">
                <h2>Official Foods</h2>
                <p>This section contains all of the essential food items that have been added by us. Remember, you can always go over to the community section and add a custom meal over there.</p>
                @forelse($officialFoods as $food)
                    <!-- Display Official Food Details -->
                    <div class="food-tab">
                        <div class="food-tab-background">
                            <h2>{{ $food->name }}</h2>
                            {{-- <p>Quantity: {{ $food->quantity }}</p> --}}
                            <p>Calories: {{ $food->calories }}</p>
                            <p>Protein: {{ $food->protein }}</p>
                            <p>Fats: {{ $food->fat }}</p>
                            <p>Carbohydrates: {{ $food->carbohydrates }}</p>
                            <p>Description: {{ $food->description }}</p>
                            @if ($food->vegetarian)
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
    </div>


    {{-- 
<div class="food-split right"> --}}
    <!-- Display Official Foods -->


    </div>
    </div>
@endsection
