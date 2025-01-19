<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Building::insertOrIgnore([
            [
                'address' => 'г. Москва, ул. Ленина, 1, офис 3',
                'coordinates' => $this->coordinate(55.7558, 37.6173),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Санкт-Петербург, ул. Невский, 5, офис 12',
                'coordinates' => $this->coordinate(59.9343,30.3351),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Казань, ул. Баумана, 15, офис 4',
                'coordinates' => $this->coordinate(55.7887, 49.1221),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Екатеринбург, ул. Революции, 6, офис 7',
                'coordinates' => $this->coordinate(56.8389, 60.6057),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Новосибирск, ул. Красный проспект, 8, офис 2',
                'coordinates' => $this->coordinate(55.0084, 82.9357),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
    
    private function coordinate($latitude, $longitude)
    {
        return DB::raw("ST_GeomFromText('POINT($longitude $latitude)', 4326)");
    }
}
