@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/branches" class="btn btn-secondary btn-sm"
           data-toggle="tooltip" data-placement="left"
           title="Branches">
            <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
            Back to Branches
        </a>
        <h1>Branch Information</h1>
        <p><strong>ID:</strong> {{ $branch->id }}</p>
        <p><strong>Name:</strong> {{ $branch->name }}</p>
        <p><strong>Location:</strong> {{ $branch->location }}</p>

        <h2>Users in this Branch</h2>

        <table class="table">
            <thead class="thead">
            <tr>
                <th>{!! trans('usersmanagement.users-table.id') !!}</th>
                <th>{!! trans('usersmanagement.users-table.name') !!}</th>
                <th class="hidden-xs">{!! trans('usersmanagement.users-table.email') !!}</th>
                <th class="hidden-xs">{!! trans('usersmanagement.users-table.fname') !!}</th>
                <th class="hidden-xs">{!! trans('usersmanagement.users-table.lname') !!}</th>
                <th>{!! trans('usersmanagement.users-table.role') !!}</th>
                <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
                <th class="no-search no-sort"></th>
                <th class="no-search no-sort"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td class="hidden-xs"><a href="mailto:{{ $user->email }}" title="email {{ $user->email }}">{{ $user->email }}</a></td>
                    <td class="hidden-xs">{{$user->first_name}}</td>
                    <td class="hidden-xs">{{$user->last_name}}</td>
                    <td>
                        @foreach ($user->roles as $user_role)
                            @if ($user_role->name == 'User')
                                @php $badgeClass = 'primary' @endphp
                            @elseif ($user_role->name == 'Admin')
                                @php $badgeClass = 'warning' @endphp
                            @elseif ($user_role->name == 'Unverified')
                                @php $badgeClass = 'danger' @endphp
                            @else
                                @php $badgeClass = 'default' @endphp
                            @endif
                            <span class="badge badge-{{$badgeClass}}">{{ $user_role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        {!! Form::open(array('url' => 'users/' . $user->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>
                        <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('users/' . $user->id) }}" data-toggle="tooltip" title="Show">
                            {!! trans('usersmanagement.buttons.show') !!}
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('users/' . $user->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                            {!! trans('usersmanagement.buttons.edit') !!}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
@endsection
