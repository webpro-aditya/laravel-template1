@extends('layouts.user_type.auth')

@section('page_title', __('Admins'))

@section('content')
<div class="bg-light p-4 rounded">
    <h5>Admins</h5>
    <div class="lead">
        Manage your admins here.
        <a href="{{ route('admins.create') }}" class="btn btn-primary btn-sm float-right">Add new user</a>
    </div>

    <div class="mt-2">
        @include('components.alert')
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">Name</th>
                <th scope="col">Email</th>
                <th scope="col" width="10%">Username</th>
                <th scope="col" width="10%">Roles</th>
                <th scope="col" width="1%" colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>
                    @foreach($user->roles as $role)
                    <span class="badge bg-primary">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td><a href="{{ route('admins.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                <td><a href="{{ route('admins.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['admins.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex">
        {!! $users->links() !!}
    </div>

</div>
@endsection