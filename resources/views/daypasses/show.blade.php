@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h1>Day Pass Details</h1>
            </div>
            <div class="card-body">
                <p class="mb-2"><strong>Email:</strong> {{ $dayPass->email }}</p>
                <p class="mb-2"><strong>Start Date:</strong> {{ $dayPass->start_date }}</p>
                <p class="mb-2"><strong>End Date:</strong> {{ $dayPass->end_date }}</p>
                <p class="mb-2"><strong>Passcode:</strong> {{ $dayPass->passcode }}</p>
                <!-- Add more details as needed -->
            </div>
        </div>
    </div>
@endsection
