<!-- resources/views/profiles/memberships.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Memberships for <span class="text-success">{{ $user->name }}</span></h2>

        @if ($activeMembership)
            <div class="card border-success mb-3">
                <div class="card-header bg-success text-white">
                    <h3>{{ $activeMembership->name }}</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-success">You currently have an active membership. Details:</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($activeMembership->pivot->start_date)->format('F d, Y') }}</li>
                        <li class="list-group-item"><strong>End Date:</strong> {{ \Carbon\Carbon::parse($activeMembership->pivot->end_date)->format('F d, Y') }}</li>
                        <li class="list-group-item"><strong>Branch:</strong> {{ $activeMembership->branch->name }}</li>
                    </ul>
                    <p class="card-text text-right text-muted" style="font-size: 20px;">
                        <strong>Passcode:</strong> <span class="text-success font-weight-bold">{{ $activeMembership->pivot->passcode }}</span>
                    </p>
                </div>
            </div>
        @else
            <p class="alert alert-info">You do not have an active membership at the moment.</p>
        @endif

        @if ($memberships->count() > 0)
            <div class="card border-primary mb-3">
                <div class="card-header bg-primary text-white">
                    <h4>Memberships History</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($memberships as $membership)
                            <li class="list-group-item">
                                <h5 class="card-title">{{ $membership->name }}</h5>
                                <p class="card-text">
                                    <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($membership->pivot->start_date)->format('F d, Y') }},
                                    <strong>End Date:</strong> {{ \Carbon\Carbon::parse($membership->pivot->end_date)->format('F d, Y') }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <p class="alert alert-warning">You have not purchased any memberships yet.</p>
        @endif
    </div>
@endsection
