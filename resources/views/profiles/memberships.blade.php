<!-- resources/views/profiles/memberships.blade.php -->

@extends('layouts.app')

@section('content')
    <div id="container">
        <h1>{{ config('app.name') }}</h1>

        <h2>Memberships for {{ $user->name }}</h2>

        @if ($activeMembership)
            <p>You currently have an active membership. Details:</p>
            <ul>
                <li><strong>Start Date:</strong> {{ $activeMembership->pivot->start_date }}</li>
                <li><strong>End Date:</strong> {{ $activeMembership->pivot->end_date }}</li>
                <li><strong>Branch:</strong> {{ $activeMembership->branch->name }}</li>
                <li><strong>Passcode:</strong> {{ $activeMembership->pivot->passcode }}</li>
            </ul>
        @else
            <p>You do not have an active membership at the moment.</p>
        @endif

        @if ($memberships->count() > 0)
            <p>Memberships History:</p>
            <ul>
                @foreach ($memberships as $membership)
                    <li>
                        <strong>Start Date:</strong> {{ $membership->pivot->start_date }},
                        <strong>End Date:</strong> {{ $membership->pivot->end_date }},
                        <strong>Passcode:</strong> {{ $membership->pivot->passcode }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>You have not purchased any memberships yet.</p>
        @endif

        <p>If you have any questions or concerns, feel free to contact us.</p>

        <p>Thanks,<br>{{ config('app.name') }}<br>© 2023 {{ config('app.name') }}. All rights reserved.</p>
    </div>
@endsection
