<!-- resources/views/daypasses/create.blade.php -->

@extends('layouts.app') {{-- Assuming you have a master layout file --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Buy a DayPass</div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('daypass.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select name="branch_id" class="form-control" required>
                                    {{-- Assuming $branches is an array of branches --}}
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Purchase DayPass</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
