<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@medilink.local'], // critère d'unicité
            [
                'name'     => 'Admin',
                'password' => Hash::make('admin12345'), // TOUJOURS hasher
                'role'     => 'admin',
            ]
        );
    }
}
