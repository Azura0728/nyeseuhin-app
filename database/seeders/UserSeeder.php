<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'is_super_admin' => true,
            ]
        );

        \App\Models\User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'is_super_admin' => false,
            ]
        );

        \App\Models\User::updateOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name' => 'Owner User',
                'password' => bcrypt('password'),
                'role' => 'owner',
                'is_super_admin' => false,
            ]
        );

        \App\Models\User::updateOrCreate(
            ['email' => 'kasir@example.com'],
            [
                'name' => 'Kasir User',
                'password' => bcrypt('password'),
                'role' => 'kasir',
                'is_super_admin' => false,
            ]
        );
    }
}
