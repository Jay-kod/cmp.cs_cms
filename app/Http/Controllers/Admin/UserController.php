<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', true)->orderBy('name')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => true,
            'role' => User::ROLE_ADMIN,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user created successfully.');
    }

    public function edit(User $user)
    {
        if (!$user->is_admin) {
            abort(404);
        }
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!$user->is_admin) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user updated successfully.');
    }

    public function destroy(User $user)
    {
        if (!$user->is_admin) {
            abort(404);
        }

        // Prevent deleting oneself
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Prevent deleting if it's the only admin
        $adminCount = User::where('is_admin', true)->count();
        if ($adminCount <= 1) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cannot delete the only remaining admin account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user deleted successfully.');
    }
}
