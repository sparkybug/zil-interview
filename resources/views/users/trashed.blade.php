@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Soft Deleted Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Deleted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->deleted_at }}</td>
                    <td>
                        <a href="{{ route('users.restore', $user->id) }}" class="btn btn-primary">Restore</a>
                        <a href="{{ route('users.delete-permanently', $user->id) }}" class="btn btn-danger">Delete Permanently</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
