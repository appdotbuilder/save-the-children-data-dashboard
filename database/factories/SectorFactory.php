<?php

namespace Database\Factories;

use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sector>
 */
class SectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sectors = [
            ['title' => 'Education', 'title_nepali' => 'शिक्षा'],
            ['title' => 'Health', 'title_nepali' => 'स्वास्थ्य'],
            ['title' => 'Infrastructure', 'title_nepali' => 'पूर्वाधार'],
            ['title' => 'Social Welfare', 'title_nepali' => 'सामाजिक कल्याण'],
            ['title' => 'Environment', 'title_nepali' => 'वातावरण'],
            ['title' => 'Agriculture', 'title_nepali' => 'कृषि'],
        ];
        
        $sector = $this->faker->randomElement($sectors);

        return [
            'title' => $sector['title'],
            'title_nepali' => $sector['title_nepali'],
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the sector is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}