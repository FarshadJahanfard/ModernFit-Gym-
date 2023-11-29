@extends('layouts.app')

@section('content')
            {{-- Homepage --}}
<div class="homepage-container">
    <div class="our-services">
        <div class="service-tab">
            <h1>Gym Access</h1>
        </div>
        <div class="service-tab">
            <h1>Workout Advice</h1>
        </div>
        <div class="service-tab">
            <h1>Nutritional Advice</h1>
        </div>
    </div>
    <div class="our-classes">
        <a href="{{ route('classes') }}"> View Classes </a>
    </div>
</div>

@endsection

