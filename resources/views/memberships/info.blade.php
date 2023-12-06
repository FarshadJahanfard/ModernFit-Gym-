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

                    <form method="POST" action="{{ route('memberships.purchase', ['membership' => $membership->id,]) }}">
                        @csrf

                        <!-- Add a dropdown for selecting the branch -->
                        <div class="form-group">
                            <label for="branch">Select Branch:</label>
                            <select name="branch" id="branch" class="form-control" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Purchase</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
