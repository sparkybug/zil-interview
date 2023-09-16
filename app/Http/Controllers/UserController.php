<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        // Retrieving users from DB
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    public function show($id): View
    {
        // Retrieve a user by their ID
        return view('users.show', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function create(): View
    {
        return view('users.create', [
            'user' => User::create()
        ]);
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // to handle photo upload if a file was provided
        if($request->hasFile('photo')) {
            // storing uploaded file in public/user-photos directory
            $path = $request->file('photo')->store('user-photos', 'public');

            // update the photo field in the user model with the file path
            $validatedData['photo'] = $path;
        }

        // Create a new user
        $user = User::create($validatedData);

        // Redirect to the user's profile page
        return redirect()->route('users.show', $user->id);
    }

}
