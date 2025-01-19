<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class OrganizationActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $organizations = Organization::pluck('id')->toArray();
        $activities = Activity::whereDoesntHave('children')->pluck('id')->toArray();
        return [
            'organization_id' => $this->faker->randomElement($organizations),
            'activity_id' => $this->faker->randomElement($activities),   
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
