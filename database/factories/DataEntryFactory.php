<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\DataEntry;
use App\Models\Municipality;
use App\Models\Sector;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataEntry>
 */
class DataEntryFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $budgetHeadlines = [
            'School Building Construction Project',
            'Primary Health Care Center Upgrade',
            'Rural Road Maintenance Program',
            'Water Supply Infrastructure Development',
            'Child Nutrition Program',
            'Community Hall Construction',
            'Agricultural Training Initiative',
            'Environmental Conservation Project',
        ];

        return [
            'user_id' => User::factory(),
            'municipality_id' => Municipality::factory(),
            'budget_headline' => $this->faker->randomElement($budgetHeadlines),
            'amount' => $this->faker->randomFloat(2, 10000, 10000000),
            'fiscal_year' => $this->faker->numberBetween(2020, 2024),
            'entry_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'tag_ids' => $this->faker->randomElements(
                Tag::pluck('id')->toArray() ?: [1, 2, 3], 
                $this->faker->numberBetween(1, 3)
            ),
            'sector_ids' => $this->faker->randomElements(
                Sector::pluck('id')->toArray() ?: [1, 2], 
                $this->faker->numberBetween(1, 2)
            ),
            'category_ids' => $this->faker->randomElements(
                Category::pluck('id')->toArray() ?: [1, 2], 
                $this->faker->numberBetween(1, 2)
            ),
        ];
    }
}