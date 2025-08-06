<?php

namespace Database\Factories;

use App\Models\Municipality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Municipality>
 */
class MunicipalityFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = [
            'Kathmandu', 'Pokhara', 'Lalitpur', 'Bharatpur', 'Biratnagar', 
            'Janakpur', 'Nepalgunj', 'Butwal', 'Dharan', 'Itahari'
        ];
        
        $districts = [
            'Kathmandu', 'Kaski', 'Lalitpur', 'Chitwan', 'Morang',
            'Dhanusha', 'Banke', 'Rupandehi', 'Sunsari', 'Sunsari'
        ];
        
        $name = $this->faker->randomElement($names);
        
        return [
            'name' => $name . ' Municipality',
            'name_nepali' => $name . ' नगरपालिका',
            'type' => $this->faker->randomElement(['rural', 'urban']),
            'district' => $this->faker->randomElement($districts),
            'district_nepali' => $this->faker->randomElement($districts) . ' जिल्ला',
            'status' => 'active',
        ];
    }

    /**
     * Indicate that the municipality is rural.
     */
    public function rural(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'rural',
            'name' => str_replace('Municipality', 'Rural Municipality', $attributes['name']),
            'name_nepali' => str_replace('नगरपालिका', 'गाउँपालिका', $attributes['name_nepali']),
        ]);
    }

    /**
     * Indicate that the municipality is urban.
     */
    public function urban(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'urban',
        ]);
    }
}