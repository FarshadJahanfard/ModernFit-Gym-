@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Diet Plan Details</h2>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ $dietPlan->diet_name }}</h5>
                <p class="card-text"><strong>Calories:</strong> {{ $dietPlan->calories }}</p>
                <p class="card-text"><strong>Protein:</strong> {{ $dietPlan->protein }}</p>
                <p class="card-text"><strong>Fats:</strong> {{ $dietPlan->fats }}</p>
                <p class="card-text"><strong>Note:</strong> {{ $dietPlan->note }}</p>

                <!-- Add any additional details you want to display -->

{{--                <a href="{{ route('plans') }}" class="btn btn-primary">Back to Diet Plans</a>--}}
            </div>
        </div>
    </div>
@endsection
