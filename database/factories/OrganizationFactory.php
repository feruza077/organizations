<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $buildings = Building::pluck('id')->toArray();

        return [
            'name' => $this->faker->unique()->company,
            'phone_numbers' => [
                $this->faker->phoneNumber(),
                $this->faker->phoneNumber(),
            ],
            'building_id' => $this->faker->randomElement($buildings),
        ];
    }
}
