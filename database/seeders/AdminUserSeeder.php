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
            ['email' => 'admin@wasmis.com'], // Replace with your admin email
            [
                'name' => 'Admin User',
                'password' => Hash::make('Admin1234'), // Replace with your password
                // 'is_admin' => true, // Uncomment this line if your table has an admin column
            ]
        );
    }
}