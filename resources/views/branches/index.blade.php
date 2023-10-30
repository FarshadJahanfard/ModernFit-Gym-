@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Branches</h1>
        <a href="/branches/create" class="btn btn-primary">Create Branch</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($branches as $branch)
                <tr>
                    <td>{{ $branch->id }}</td>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->location }}</td>
                    <td>
                        <a href="{{ '/branches/' . $branch->id . "/edit" }}" class="btn btn-primary">Edit</a>
                        <form action="{{ 'branches/' . $branch->id . "destroy/" }}" method="POST" style="display:inline">
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
@endsection
