<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder user
        User::create([
            "name"=> "Super Admin",
            "email"=> "superadmin@developer.com",
            "password"=> bcrypt('Password!2')
        ]);
    }
}
