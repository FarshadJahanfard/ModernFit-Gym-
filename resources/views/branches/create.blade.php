@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Branch</h1>
        <a href="/branches" class="btn btn-secondary btn-sm"
           data-toggle="tooltip" data-placement="left"
           title="Branches">
            <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
            Back to Branches
        </a>

        <form action="/branches" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" name="location" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
