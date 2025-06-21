<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 2)->where('role_id', '!=', 1)->get();
        return view('user.index', compact("users"));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|in:3,4',
            'status' => 'required|in:0,1',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|in:3,4',
            'status' => 'required|in:0,1',
        ]);

        $user->update($validated);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    public function deactivate(User $user)
    {
        $user->update(['status' => 0]);

        return redirect()->route('user.index')->with('success', 'User berhasil dinonaktifkan');
    }

    public function activate(User $user)
    {
        $user->update(['status' => 1]);

        return redirect()->route('user.index')->with('success', 'User berhasil diaktifkan');
    }
}
