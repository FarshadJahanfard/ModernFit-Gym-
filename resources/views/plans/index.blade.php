@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Your Workout Plans</h2>

        @if(count($workoutPlans) > 0)
            <ul class="list-group mt-3">
                @foreach($workoutPlans as $workoutPlan)
                    <li class="list-group-item">
                        {{ $workoutPlan->name }}
                        <div class="float-right">
                            <a href="{{ route('workout_plans.edit', ['id' => $workoutPlan->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('workout_plans.destroy', ['id' => $workoutPlan->id]) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>You don't have any workout plans yet.</p>
        @endif
    </div>
@endsection
