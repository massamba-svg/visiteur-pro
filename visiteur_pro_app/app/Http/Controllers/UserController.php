<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Afficher le formulaire de création d'utilisateur
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'role_id' => 'required|exists:roles,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('roles.index')
                         ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Afficher le formulaire d'édition d'utilisateur
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'role_id' => 'required|exists:roles,id',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('roles.index')
                         ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprimer un utilisateur
     */
    public function destroy(User $user)
    {
        // Empêcher la suppression de son propre compte
        if ($user->id === Auth::id()) {
            return redirect()->route('roles.index')
                             ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('roles.index')
                         ->with('success', 'Utilisateur supprimé avec succès.');
    }

    /**
     * Assigner un rôle à plusieurs utilisateurs
     */
    public function bulkAssignRole(Request $request)
    {
        $userIds = json_decode($request->user_ids, true);
        $roleId = $request->role_id;
        
        if (empty($userIds)) {
            return back()->with('error', 'Aucun utilisateur sélectionné.');
        }
        
        User::whereIn('id', $userIds)->update(['role_id' => $roleId]);
        
        return back()->with('success', count($userIds) . ' utilisateur(s) mis à jour avec succès.');
    }

    /**
     * Supprimer plusieurs utilisateurs
     */
    public function bulkDelete(Request $request)
    {
        $userIds = json_decode($request->user_ids, true);
        
        if (empty($userIds)) {
            return back()->with('error', 'Aucun utilisateur sélectionné.');
        }
        
        // Empêcher la suppression de l'utilisateur connecté
        $userIds = array_filter($userIds, fn($id) => $id !== Auth::id());
        
        User::whereIn('id', $userIds)->delete();
        
        return back()->with('success', count($userIds) . ' utilisateur(s) supprimé(s) avec succès.');
    }
}
