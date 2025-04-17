<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin@clickneat.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Client',
            'prenom' => 'Jean',
            'email' => 'client@clickneat.test',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        User::create([
            'name' => 'Restaurateur',
            'prenom' => 'Marie',
            'email' => 'restaurateur@clickneat.test',
            'password' => Hash::make('password'),
            'role' => 'restaurateur',
        ]);

        User::create([
            'name' => 'Employé',
            'prenom' => 'Paul',
            'email' => 'employe@clickneat.test',
            'password' => Hash::make('password'),
            'role' => 'employe',
        ]);
    }
}
