<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole  = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();
        $userRole   = Role::where('name', 'user')->first();

        // Admin
        User::firstOrCreate(
            ['email' => 'admin@tugasweb.com'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('password'),
                'role_id'  => $adminRole->id,
            ]
        );

        // Editor
        User::firstOrCreate(
            ['email' => 'editor@tugasweb.com'],
            [
                'name'     => 'Editor Konten',
                'password' => Hash::make('password'),
                'role_id'  => $editorRole->id,
            ]
        );

        // Regular Users
        User::firstOrCreate(
            ['email' => 'user@tugasweb.com'],
            [
                'name'     => 'User Biasa',
                'password' => Hash::make('password'),
                'role_id'  => $userRole->id,
            ]
        );

        // Generate 10 user tambahan dengan factory
        User::factory(10)->create(['role_id' => $userRole->id]);
    }
}
