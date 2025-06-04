<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tellmefilm.com',
            'password' => Hash::make('admin123'), // Cambia la contraseña si lo deseas
            'role' => 'admin',
        ]);
    }
}
