<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Survival',
                'title_nepali' => 'अस्तित्व',
                'status' => 'active',
            ],
            [
                'title' => 'Protection',
                'title_nepali' => 'संरक्षण',
                'status' => 'active',
            ],
            [
                'title' => 'Development',
                'title_nepali' => 'विकास',
                'status' => 'active',
            ],
            [
                'title' => 'Participation',
                'title_nepali' => 'सहभागिता',
                'status' => 'active',
            ],
            [
                'title' => 'Institutional',
                'title_nepali' => 'संस्थागत',
                'status' => 'active',
            ],
            [
                'title' => 'Extracting',
                'title_nepali' => 'निकासी',
                'status' => 'active',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}