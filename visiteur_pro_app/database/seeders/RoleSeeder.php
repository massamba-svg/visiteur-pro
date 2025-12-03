<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Administrateur',
            'description' => 'Accès complet à l\'application',
        ]);

        Role::create([
            'name' => 'Gestionnaire',
            'description' => 'Gestion des visites et des clients',
        ]);

        Role::create([
            'name' => 'Réceptionniste',
            'description' => 'Enregistrement des visites uniquement',
        ]);
    }
}
