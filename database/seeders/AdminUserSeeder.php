<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Récupérer ou créer le rôle admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // 2. Récupérer TOUTES les permissions déjà créées
        $allPermissions = Permission::all();

        // 3. Synchroniser les permissions avec le rôle
        $adminRole->syncPermissions($allPermissions);

        // 4. Liste des administrateurs à créer ou mettre à jour
        $admins = [
            [
                'email' => 'loiceway@gmail.com',
                'nom' => 'LOIC',
                'prenom' => '',
                'role' => 'admin',
                'adresse' => 'Douala, Cameroun',
                'phone' => '672553378',
                'code_postal' => '00237',
                'password' => Hash::make('672553378'),
            ],
            [
                'email' => 'tuemothomas@gmail.com',
                'nom' => 'Tuemo',
                'prenom' => 'Thomas',
                'role' => 'admin',
                'adresse' => 'Douala, Cameroun',
                'phone' => '672959424',
                'code_postal' => '00237',
                'password' => Hash::make('Thomastuemo@01'),
            ],
            [
                'email' => 'thomastuemo@gmail.com', // Doublon potentiel géré proprement
                'nom' => 'Tuemo',
                'prenom' => 'Thomas',
                'role' => 'admin',
                'adresse' => 'Douala, Cameroun',
                'phone' => '672959424',
                'code_postal' => '00237',
                'password' => Hash::make('Thomastuemo@01'),
            ],
        ];

        // 5. Boucle pour créer les utilisateurs et leur assigner le rôle
        foreach ($admins as $adminData) {
            $user = User::updateOrCreate(
                ['email' => $adminData['email']], 
                $adminData
            );

            // Assigner le rôle Spatie s'il ne l'a pas déjà
            if (!$user->hasRole($adminRole)) {
                $user->assignRole($adminRole);
            }

            $this->command->info("L'utilisateur {$user->email} a été créé/mis à jour et possède toutes les permissions !");
        }
    }
}
////php artisan db:seed --class=AdminUserSeeder