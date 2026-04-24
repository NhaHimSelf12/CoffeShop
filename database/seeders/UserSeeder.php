<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Da Panha',
            'email' => 'admin@pos.com',
            'password' => Hash::make('password'),
            'role' => 'admin', // Initial Admin Setup
        ]);

        // Also create a default staff for easy testing if needed
        User::create([
            'name' => 'Staff Member',
            'email' => 'staff@pos.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);
    }
}
