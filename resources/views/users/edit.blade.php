@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Use PUT method for updates --}}
        <div class="form-group">
            <label for="prefixname">Prefix Name</label>
            <input type="text" class="form-control" id="prefixname" name="prefixname" value="{{ old('prefixname', $user->prefixname) }}" required>
        </div>
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
        </div>
        <div class="form-group">
            <label for="middlename">Middle Name</label>
            <input type="text" class="form-control" id="middlename" name="middlename" value="{{ old('middlename', $user->middlename) }}" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
        </div>
        <div class="form-group">
            <label for="suffixname">Suffix Name</label>
            <input type="text" class="form-control" id="suffixname" name="suffixname" value="{{ old('suffixname', $user->suffixname) }}" required>
        </div>
        <div class="form-group">
            <label for="username">First Name</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="{{ old('password', $user->password) }}" required>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control-file" id="photo" name="photo" value="{{ old('photo', $user->photo) }}">
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
