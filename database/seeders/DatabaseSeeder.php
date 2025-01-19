<?php

namespace Database\Seeders;

use App\Models\OrganizationActivity;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BuildingSeeder::class,
            ActivitySeeder::class,
            OrganizationSeeder::class,
            OrganizationActivitySeeder::class
        ]);
    }
}
