@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($memberships as $membership)
            <div class="card mb-3">
                <div class="card-header">
                    <h4>{{ $membership->name }} Membership Information</h4>
                </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $membership->name }}</p>
                    <p><strong>Price:</strong> ${{ $membership->price }}</p>
                    <p><strong>Description:</strong> {{ $membership->description }}</p>
                    <!-- Add any additional information or details here -->

                    <form method="POST" action="{{ route('memberships.purchase', ['membership' => $membership->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Purchase</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
