<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Retrieving users from DB
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        // Retrieve a user by their ID
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'prefixname' => ['nullable', 'string', 'in:Mr,Mrs,Ms'],
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffixname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255',
            // Add more validation rules as needed
        ]);

        // Create a new user
        $user = User::create($validatedData);

        // Redirect to the user's profile page or another appropriate page
        return redirect()->route('users.show', $user->id);
    }

}
