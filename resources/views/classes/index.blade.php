@extends('layouts.app')

@section('content')

<style>

.class-group{
    background: white;
    margin: 2rem;
    padding: 1rem;
    border-radius: 16px;
    height: 720px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
}

.class-list{
    height: 90%;
}

</style>

<div class="classes-container">
    <div class="class-group">
        <h2 class="classes-title">Available Classes</h2>
        <div class="class-list">
            @forelse($classes as $class)
                <div class="class-tab">
                    <h2 id="title-food">{{ $class->title }}</h2>
                    <p id="title-food">When: {{ $class->date }} Time: {{ $class->time }}</p>
                    <p id="title-food">Description: {{ $class->description }}</p>
                    @if (Auth::check() && Auth::user()->classes->contains($class->id))
                        <button class="btn btn-secondary btn-sm" disabled>Registered</button>
                    @else
                        <form action="{{ route('addClass', ['id' => $class->id]) }}" method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">Attend</button>
                        </form>
                    @endif

                </div>
            @empty
                <p>No classes available.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
