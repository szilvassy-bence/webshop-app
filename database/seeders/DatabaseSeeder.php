<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'User',
            'email' => 'user@user',
            'password' => Hash::make('password'),
        ]);

        Admin::factory(3)->create();

        Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => Hash::make('password'),
            'status' => 1
        ]);
    }
}
