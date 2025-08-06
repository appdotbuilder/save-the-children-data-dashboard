<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ['title' => 'Survival', 'title_nepali' => 'अस्तित्व'],
            ['title' => 'Protection', 'title_nepali' => 'संरक्षण'],
            ['title' => 'Development', 'title_nepali' => 'विकास'],
            ['title' => 'Participation', 'title_nepali' => 'सहभागिता'],
            ['title' => 'Institutional', 'title_nepali' => 'संस्थागत'],
            ['title' => 'Extracting', 'title_nepali' => 'निकासी'],
        ];
        
        $category = $this->faker->randomElement($categories);

        return [
            'title' => $category['title'],
            'title_nepali' => $category['title_nepali'],
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the category is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}