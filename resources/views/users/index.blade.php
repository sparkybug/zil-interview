@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <!-- Add more table headers for additional user attributes -->
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <!-- Add more table data for additional user attributes -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
