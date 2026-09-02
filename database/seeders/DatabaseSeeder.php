<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan penting — ikuti dependency order
        $this->call([
            AdminUserSeeder::class,
            CompanyProfileSeeder::class,
            AboutContentSeeder::class,
            VisionMissionSeeder::class,
            ManagementSeeder::class,
            ProductServiceSeeder::class,
            SubsidiarySeeder::class,
        ]);
    }
}
