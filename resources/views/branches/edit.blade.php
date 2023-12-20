@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Branch</h1>
        <a href="/branches" class="btn btn-secondary btn-sm"
           data-toggle="tooltip" data-placement="left"
           title="Branches">
            <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
            Back to Branches
        </a>

        <form action="/branches/{{ $branch->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class = "required" for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ $branch->name }}" required>
            </div>
            <div class="form-group">
                <label class = "required" for="location">Location:</label>
                <input type="text" name="location" class="form-control" value="{{ $branch->location }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <hr>
        <form action="{{ 'branches/' . $branch->id . "destroy/" }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
@endsection
