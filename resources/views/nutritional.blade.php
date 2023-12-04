@extends('layouts.app')

@section('content')
            {{-- Homepage --}}
<div class="homepage-container">
    <form action="{{ route('welcome') }}" method="get">
        <button type="submit" class="view-class-btn">Home</button>
    </form>
    <h1>Nutritional</h1>
</div>

@endsection

