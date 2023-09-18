<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        // Retrieving users from DB
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show(User $user): View
    {
        // Retrieve a user by their ID
        return view('users.show', compact('user'));
    }

    public function create(): View
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

    public function edit(User $user): View
    {
        // Retrieve a single user instance
        // $users = User::findOrFail($user->id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        // Validation rules for updating user data
        $request->validate([
            'prefixname' => ['nullable', 'string', 'in:Mr,Mrs,Ms'],
            'firstname' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffixname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle photo upload (if provided)
        // if ($request->hasFile('photo')) {
        //     // storing uploaded file in public/user-photos directory
        //     $path = $request->file('photo')->store('user-photos', 'public');

        //     // update the photo field in the user model with the file path
        //     $validatedData['photo'] = $path;
        // }

        // Update user data
        // $user = User::findOrFail($user->id);
        $user->update($request->all());

        // Redirect to the user's profile page or another appropriate page
        return response()->route('users.index')->with('success', 'profile updated successfully');

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    public function trashed(): View
    {
        // Retrieve all soft deleted users
        $users = User::onlyTrashed()->get();

        return view('users.index', compact('users'));
    }

    public function restore(User $user)
    {
        $user->restore();

        return redirect()->route('users.trashed');
    }

    public function deletePermanently(User $user)
    {
        $user->forceDelete();

        return redirect()->route('users.trashed');
    }

}