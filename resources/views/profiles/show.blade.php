@extends('layouts.app')

@section('template_title')
    {{ $user->name }}'s Profile
@endsection

@section('template_fastload_css')
    #map-canvas{
        min-height: 300px;
        height: 100%;
        width: 100%;
    }
@endsection

@php
    $currentUser = Auth::user()
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <h2>{{ $user->name }}</h2>
                        <p>Email: {{ $user->email }}</p>

                        <h3>Memberships</h3>
                        @if ($user->memberships()->count() > 0)
                            <ul>
                                @foreach ($user->memberships as $membership)
                                    <li>
                                        Membership Name: {{ $membership->name }}
                                        <br>
                                        Price: {{ $membership->price }}
                                        <br>
                                        Description: {{ $membership->description }}
                                        <br>
                                        Start Date: {{ $membership->pivot->start_date }}
                                        <br>
                                        End Date: {{ $membership->pivot->end_date }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No memberships found.</p>
                        @endif

                        <h3>Active Membership</h3>
                        @if ($user->activeMembership())
                            <p>
                                Membership Name: {{ $user->activeMembership()->name }}
                                <br>
                                Price: {{ $user->activeMembership()->price }}
                                <br>
                                Description: {{ $user->activeMembership()->description }}
                                <br>
                                Start Date: {{ $membership->pivot->start_date }}
                                <br>
                                End Date: {{ $membership->pivot->end_date }}
                            </p>
                        @else
                            <p>No active membership found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--@section('footer_scripts')--}}

{{--    @if(config('settings.googleMapsAPIStatus'))--}}
{{--        @include('scripts.google-maps-geocode-and-map')--}}
{{--    @endif--}}

{{--@endsection--}}
