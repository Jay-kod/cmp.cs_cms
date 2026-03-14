<?php

namespace App\Http\Controllers\SuperAdmin;

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
        return view('super-admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('super-admin.users.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:' . User::ROLE_ADMIN . ',' . User::ROLE_SUPER_ADMIN],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => true,
            'role' => $validated['role'],
        ]);

        return redirect()->route('super-admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        if (!$user->is_admin) {
            abort(404);
        }
        return view('super-admin.users.form', compact('user'));
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
            'role' => ['required', 'in:' . User::ROLE_ADMIN . ',' . User::ROLE_SUPER_ADMIN],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('super-admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (!$user->is_admin) {
            abort(404);
        }

        if (auth()->id() === $user->id) {
            return redirect()->route('super-admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $adminCount = User::where('is_admin', true)->count();
        if ($adminCount <= 1) {
            return redirect()->route('super-admin.users.index')
                ->with('error', 'Cannot delete the only remaining admin account.');
        }

        $user->delete();

        return redirect()->route('super-admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
