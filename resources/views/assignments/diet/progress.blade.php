<!-- resources/views/assignments/diet/progress.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Diet Assignment Progress</h2>

        <div class="row">
            <div class="col-md-6">
                <h3>Diet Plan Details</h3>
                <p><strong>Start Date:</strong> {{ $assignment->start_date }}</p>
                <p><strong>End Date:</strong> {{ $assignment->end_date }}</p>
                <p><strong>Note:</strong> {{ $assignment->note }}</p>

                <h3>Diet Logs</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Calories</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->name }}</td>
                            <td>{{ $log->calories }}</td>
                            <td>{{ $log->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
