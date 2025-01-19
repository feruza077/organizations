<?php

namespace Database\Seeders;

use App\Models\OrganizationActivity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizationActivities = OrganizationActivity::factory(500)->make()->toArray();
        OrganizationActivity::insertOrIgnore($organizationActivities);
    }
}
