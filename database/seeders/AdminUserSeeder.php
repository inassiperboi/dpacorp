<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin utama
        User::create([
            'name'     => 'Administrator DPA Corp',
            'email'    => 'admin@dpacorp.id',
            'password' => 'dpacorp2024',  // plaintext sesuai requirement
            'role'     => 'admin',
        ]);

        // Editor
        User::create([
            'name'     => 'Editor Konten',
            'email'    => 'editor@dpacorp.id',
            'password' => 'editor2024',
            'role'     => 'editor',
        ]);
    }
}
