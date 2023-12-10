@extends('layouts.app')

@section('content')

<div class="classes-container">
    <div class="class-tab">
        <h2>Available Classes</h2>
        <div class="foods-list">
            @forelse($classes as $class)
                <div class="food-tab">
                    <h2>{{ $class->title }}</h2>
                    <p>When: {{ $class->date }} Time: {{ $class->time }}</p>
                    <p>Description: {{ $class->description }}</p>
                    <!-- Other food details... -->
                    <!-- Form to add food to user's list -->
                    <form action="{{ route('addClass', ['id' => $class->id]) }}" method="post">
                        @csrf
                        <button type="submit">Attend</button>
                    </form>
                </div>
            @empty
                <p>No classes available.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection