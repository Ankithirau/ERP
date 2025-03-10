<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $user = $user = User::orderBy('id', 'desc')->paginate(10);
        return view('user.index', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        // Validate input fields
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,editor,user',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password for security
            'role' => $request->role,
        ]);

        // Redirect with success message
        return redirect()->route('index')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch the user by ID
        return view('user.edit', compact('user')); // Pass the user to the edit form
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,teacher,peon',
            'password' => 'nullable|min:6', // Password is optional but must be at least 6 characters if provided
        ]);

        // Find user by ID
        $user = User::findOrFail($id);

        // Update fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Update password only if a new one is provided
        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }

        // Save changes
        $user->save();

        // Redirect to index with success message
        return redirect()->route('index')->with('success', 'User updated successfully!');
    }

    public function view($id)
    {
        $user = User::findOrFail($id); // Fetch the user by ID
        return view('user.show', compact('user')); // Pass the user to the edit form
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('index')->with('success', 'User deleted successfully!');
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('user.profile', compact('user'));
    }

    public function profileUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

}
