<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $user = Auth::user();
        
        return view('settings.index', compact('user'));
    }

    /**
     * Update user preferences.
     */
    public function updatePreferences(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'email_notifications' => 'boolean',
            'system_notifications' => 'boolean',
            'analytics_data' => 'boolean',
        ]);

        // Store preferences (could be in a user_preferences table or user settings JSON column)
        // For now, we'll flash a success message
        
        return back()->with('success', 'Préférences mises à jour avec succès.');
    }
}
