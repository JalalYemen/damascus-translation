<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash; 
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'jalalaljabri63@gmail.com')->exists()) { 
            User::create([
                'name' => 'Admin User',
                'email' => 'jalalaljabri63@gmail.com', 
                'password' => Hash::make('Jalal_laravel_21'), 
                'is_admin' => true, 
                'email_verified_at' => now(), 
            ]);
        }
    }
}
