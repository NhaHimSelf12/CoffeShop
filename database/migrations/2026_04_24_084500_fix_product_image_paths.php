<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Updates product image paths from generic placeholders to the actual
     * hashed filenames stored in public/storage/products/.
     */
    public function up(): void
    {
        DB::table('products')->where('name', '=', 'Matcha Latte')->update([
            'image' => 'products/uOG0xy5BDYp6sX4Quk1msu9vEty8PWydCDLTTXOH.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Coffe Latte')->update([
            'image' => 'products/OofcWkiUksoBuSzurdrB6diwsNpmQpgTuHDfRdt7.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Strawberry Late')->update([
            'image' => 'products/s0WcwYAbNkp03DQNtElnWtpajTLDUZjgEyTgNHKf.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Green Tea Latte')->update([
            'image' => 'products/uhqB5w4UpMMRQsPAJosm5ehPYfj4ZiYKew6p9cpV.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Espresso')->update([
            'image' => 'products/TkR7yMBWj1xKsuRp7RvM4y1fG7uEHDKCttJhUX8v.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Americano')->update([
            'image' => 'products/YoUT6jtqcXYBNUnai4r4vbk3oV20xsuS1CxyNBrr.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Ice Latte')->update([
            'image' => 'products/yV7nibtfH1cb3UAvkNyFLyn91CMXa3Hd530lqefE.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Freddo')->update([
            'image' => 'products/4b9LDicnM00R2uWaKkRTKrJbG8AXKnC0AhdljXvI.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Chicken Burger')->update([
            'image' => 'products/W91JJCdjXNpTLb5xqpJli5LJwSEG4EsokEcSyPYk.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Cream Orange')->update([
            'image' => 'products/u5rTsbchbKgBPHrjElU0O50U60rozZpEpty7xJQ5.jpg',
        ]);
    }

    /**
     * Reverse the migrations.
     * Restores the original placeholder image paths.
     */
    public function down(): void
    {
        DB::table('products')->where('name', '=', 'Matcha Latte')->update([
            'image' => 'products/matcha-latte.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Coffe Latte')->update([
            'image' => 'products/coffe-latte.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Strawberry Late')->update([
            'image' => 'products/strawberry-late.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Green Tea Latte')->update([
            'image' => 'products/green-tea-latte.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Espresso')->update([
            'image' => 'products/espresso.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Americano')->update([
            'image' => 'products/americano.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Ice Latte')->update([
            'image' => 'products/ice-latte.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Freddo')->update([
            'image' => 'products/freddo.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Chicken Burger')->update([
            'image' => 'products/chicken-burger.jpg',
        ]);

        DB::table('products')->where('name', '=', 'Cream Orange')->update([
            'image' => 'products/cream-orange.jpg',
        ]);
    }
};
