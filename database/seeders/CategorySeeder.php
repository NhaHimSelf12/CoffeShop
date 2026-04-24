<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Coffee', 'Non-Coffee', 'Pastry', 'Main Course'];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }
    }
}
