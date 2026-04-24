<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $coffee = Category::where('name', 'Coffee')->first();
        $non_coffee = Category::where('name', 'Non-Coffee')->first();
        $pastry = Category::where('name', 'Pastry')->first();

        Product::create(['category_id' => $coffee->id, 'name' => 'Signature Latte', 'price' => 28000, 'stock' => 100]);
        Product::create(['category_id' => $coffee->id, 'name' => 'Signature Americano', 'price' => 22000, 'stock' => 100]);
        Product::create(['category_id' => $non_coffee->id, 'name' => 'Matcha Latte', 'price' => 32000, 'stock' => 50]);
        Product::create(['category_id' => $pastry->id, 'name' => 'Butter Croissant', 'price' => 18000, 'stock' => 30]);
        Product::create(['category_id' => $pastry->id, 'name' => 'Cheese Cake Slice', 'price' => 35000, 'stock' => 20]);
    }
}
