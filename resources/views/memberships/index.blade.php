@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Memberships</h1>
                <a class="btn btn-success" href="{{ route('memberships.create') }}">Create New Membership</a>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($memberships as $membership)
                        <tr>
                            <td>{{ $membership->id }}</td>
                            <td>{{ $membership->name }}</td>
                            <td>{{ $membership->price }}</td>
                            <td>{{ $membership->description }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('memberships.edit', $membership->id) }}">Edit</a>
                                <form method="POST" action="{{ route('memberships.destroy', $membership->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
