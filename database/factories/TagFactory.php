<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $englishHeadings = [
            'Education Infrastructure',
            'Health Care Services',
            'Water Supply System',
            'Road Construction',
            'Child Protection Program',
            'Community Development',
            'Agricultural Support',
            'Environmental Protection',
        ];
        
        $nepaliHeadings = [
            'शिक्षा पूर्वाधार',
            'स्वास्थ्य सेवा',
            'खानेपानी व्यवस्था',
            'सडक निर्माण',
            'बाल संरक्षण कार्यक्रम',
            'समुदायिक विकास',
            'कृषि सहायता',
            'वातावरण संरक्षण',
        ];

        $index = $this->faker->numberBetween(0, count($englishHeadings) - 1);

        return [
            'budget_heading_english' => $englishHeadings[$index],
            'budget_heading_nepali' => $nepaliHeadings[$index],
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the tag is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}