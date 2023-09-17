@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Use PUT method for updates --}}
        <div class="form-group">
            <label for="prefixname">Prefix Name</label>
            <input type="text" class="form-control" id="prefixname" name="prefixname" value="{{ $user->prefixname }}" required>
        </div>
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}" required>
        </div>
        <div class="form-group">
            <label for="middlename">Middle Name</label>
            <input type="text" class="form-control" id="middlename" name="middlename" value="{{  $user->middlename }}" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{  $user->lastname }}" required>
        </div>
        <div class="form-group">
            <label for="suffixname">Suffix Name</label>
            <input type="text" class="form-control" id="suffixname" name="suffixname" value="{{  $user->suffixname }}" required>
        </div>
        <div class="form-group">
            <label for="username">First Name</label>
            <input type="text" class="form-control" id="username" name="username" value="{{  $user->username }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="{{ $user->password }}" required>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" class="form-control-file" id="photo" name="photo">
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
