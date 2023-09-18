<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieving users from DB
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
        return redirect()->route('users.index', $user->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         // Retrieve a user by their ID
         $user = User::findOrFail($id);
         return view('users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
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
        return redirect()->route('users.show')->with('success', 'profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function trashed()
    {
        // Retrieve all soft deleted users
        $users = User::onlyTrashed()->get();

        return view('users.trashed', compact('users'));
    }
}
