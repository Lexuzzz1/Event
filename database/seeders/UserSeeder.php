<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID role yang bukan guest
        $roles = DB::table('roles')
            ->where('name', '!=', 'guest')
            ->pluck('id', 'name');

        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roles['admin'],
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Member
        User::create([
            'name' => 'Member User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roles['user'],
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Panitia
        User::create([
            'name' => 'Panitia User',
            'email' => 'panitia@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roles['panitia'],
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        // Keuangan
        User::create([
            'name' => 'Keuangan User',
            'email' => 'keuangan@example.com',
            'password' => Hash::make('password'),
            'role_id' => $roles['keuangan'],
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
