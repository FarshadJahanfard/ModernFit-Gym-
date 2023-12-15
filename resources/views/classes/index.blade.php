@extends('layouts.app')

@section('content')

<div class="classes-container">
    <div class="class-group">
        <h2 class="classes-title">Available Classes</h2>
        <div class="class-list">
            @forelse($classes as $class)
                <div class="class-tab">
                    <h2 id="title-food">{{ $class->title }}</h2>
                    <p id="title-food">When: {{ $class->date }} Time: {{ $class->time }}</p>
                    <p id="title-food">Description: {{ $class->description }}</p>
                    <!-- Other food details... -->
                    <!-- Form to add food to user's list -->
                    <form action="{{ route('addClass', ['id' => $class->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">Attend</button>
                    </form>
                </div>
            @empty
                <p>No classes available.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
