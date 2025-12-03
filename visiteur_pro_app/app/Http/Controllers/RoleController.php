<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->get();
        $users = User::with('role')->orderBy('name')->get();
        
        return view('roles.index', compact('roles', 'users'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string|max:500',
        ]);

        Role::create($validated);

        return redirect()->route('roles.index')
                         ->with('success', 'Rôle créé avec succès.');
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:500',
        ]);

        $role->update($validated);

        return redirect()->route('roles.index')
                         ->with('success', 'Rôle mis à jour avec succès.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return redirect()->route('roles.index')
                             ->with('error', 'Impossible de supprimer un rôle attribué à des utilisateurs.');
        }

        $role->delete();

        return redirect()->route('roles.index')
                         ->with('success', 'Rôle supprimé avec succès.');
    }

    public function assignRole(Request $request, User $user)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update(['role_id' => $validated['role_id']]);

        return redirect()->route('roles.index')
                         ->with('success', 'Rôle attribué avec succès.');
    }
}
