<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Fruits',
            'Vegetables',
            'Grains',
            'Legumes',
            'Nuts & Seeds',
            'Tubers & Roots',
            'Herbs & Spices',
            'Livestock & Poultry',
            'Dairy Products',
            'Aquaculture & Fishery',
            'Mineral Resource',
            'Others'
        ];
        foreach ($categories as $cat) {
            Category::factory()->create(['category' => $cat]);
        }
    }
}
