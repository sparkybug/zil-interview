@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Profile</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $user->firstname }} {{ $user->lastname }}</h5>
            <p class="card-text">Email: {{ $user->email }}</p>
            <!-- Add more user details as needed -->
        </div>
    </div>
</div>
@endsection
