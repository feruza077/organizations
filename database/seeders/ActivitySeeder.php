<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            //category 1
            $food = Activity::create([
                'name' => 'Еда', 
                'parent_id' => null, 
            ]);
            
            $automobile = Activity::create([
                'name' => 'Автомобили', 
                'parent_id' => null, 
            ]);

            //category 2
            $food11 = $food->children()->create([
                'name' => 'Мясная продукция', 
            ]);

            $food12 = $food->children()->create([
                'name' => 'Молочная продукция', 
            ]);

            $automobile11 = $automobile->children()->create([
                'name' => 'Грузовые', 
            ]);

            $automobile12 = $automobile->children()->create([
                'name' => 'Легковые автомобили', 
            ]);

            //category 3
            $food21 = $food11->children()->create([
                'name' => 'Говядина', 
            ]);

            $food22 = $food12->children()->create([
                'name' => 'Молоко', 
            ]);

            $food23 = $food12->children()->create([
                'name' => 'Сыр', 
            ]);

            $automobile21 = $automobile12->children()->create([
                'name' => 'Gentra Elegant', 
            ]);

            $automobile22 = $automobile12->children()->create([
                'name' => 'KIA k8', 
            ]);

            $automobile23 = $automobile11->children()->create([
                'name' => 'CHANGAN T-8', 
            ]);

            $automobile24 = $automobile11->children()->create([
                'name' => 'LABO', 
            ]);

            //category 4
            $food32 = $food22->children()->create([
                'name' => 'Йогурты', 
            ]);

            $food33 = $food22->children()->create([
                'name' => 'Кефир', 
            ]);

        } catch (\Exception $e) {
            Log::error('Ошибка при создании деятельности: ' . $e->getMessage());
        }
    }
}
