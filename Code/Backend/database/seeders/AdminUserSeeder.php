<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur admin pour le portfolio
        User::create([
            'name' => 'Abderrahman Ahlalay',
            'email' => 'abderrahmanahlalay76@gmail.com',
            'password' => Hash::make('wxcvbn@@@@0000'),
            'email_verified_at' => now(),
        ]);
        
        $this->command->info('Utilisateur admin créé avec succès !');
        $this->command->info('Email: abderrahmanahlalay76@gmail.com');
        $this->command->info('Mot de passe: wxcvbn@@@@0000');
        $this->command->warn('⚠️  IMPORTANT: Changez le mot de passe en production !');
    }
}
