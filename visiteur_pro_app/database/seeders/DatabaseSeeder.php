<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer les rôles en premier
        $this->call(RoleSeeder::class);

        // Créer un utilisateur administrateur
        $adminRole = \App\Models\Role::where('name', 'Administrateur')->first();
        
        User::factory()->create([
            'name' => 'Admin',
            'first_name' => 'Kara',
            'email' => 'admin@karasamb.com',
            'role_id' => $adminRole?->id,
        ]);

        // Créer un utilisateur gestionnaire
        $managerRole = \App\Models\Role::where('name', 'Gestionnaire')->first();
        
        User::factory()->create([
            'name' => 'Gestionnaire',
            'first_name' => 'Jean',
            'email' => 'gestionnaire@karasamb.com',
            'role_id' => $managerRole?->id,
        ]);

        // Créer quelques clients de test
        \App\Models\Client::factory(5)->create();
    }
}
