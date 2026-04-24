<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Clears seeder data and inserts real categories, products, and users.
     */
    public function up(): void
    {
        // Disable foreign key checks to allow truncation of constrained tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::table('customers')->truncate();
        DB::table('team_members')->truncate();
        DB::table('users')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // ── Categories ────────────────────────────────────────────────────────
        DB::table('categories')->insert([
            [
                'id'         => 1,
                'name'       => 'Coffee',
                'image'      => 'categories/DtRWFASq5Mz1dcAkqMmaDFyEiZVWLyd0yZdBNTWv.jpg',
                'created_at' => '2026-03-24 07:51:21',
                'updated_at' => '2026-03-24 07:51:21',
            ],
            [
                'id'         => 2,
                'name'       => 'Strawberry Late',
                'image'      => 'categories/c61zmjFrdB3T5GyghLb5JT6DG01b3hWCET5ogR9W.jpg',
                'created_at' => '2026-03-24 07:51:21',
                'updated_at' => '2026-03-24 07:51:21',
            ],
            [
                'id'         => 4,
                'name'       => 'Green Tea Latte',
                'image'      => 'categories/7CNduwCm5LR16k9sq3b11jnRMsSLdhsnqNfaUM6n.jpg',
                'created_at' => '2026-03-24 07:51:21',
                'updated_at' => '2026-03-24 07:51:21',
            ],
            [
                'id'         => 5,
                'name'       => 'Matcha Latte',
                'image'      => 'categories/yyo7xHU8DcaD0qRL7P4hh80jHGkvrxa02WWVsxsW.jpg',
                'created_at' => '2026-03-24 07:51:21',
                'updated_at' => '2026-03-24 07:51:21',
            ],
            [
                'id'         => 7,
                'name'       => 'Burger',
                'image'      => 'categories/VICxDKtNabiVIftw2ImmNlz727lWWGKt0y5BvjpS.jpg',
                'created_at' => '2026-03-24 07:51:21',
                'updated_at' => '2026-03-24 07:51:21',
            ],
            [
                'id'         => 8,
                'name'       => 'Toy',
                'image'      => 'categories/bZuxHzKCCoFUqp3abl1yeKrHNmSO0A9BP9I0FKcV.jpg',
                'created_at' => '2026-03-24 07:51:21',
                'updated_at' => '2026-03-24 07:51:21',
            ],
        ]);

        // ── Products ──────────────────────────────────────────────────────────
        DB::table('products')->insert([
            [
                'category_id' => 5,
                'name'        => 'Matcha Latte',
                'price'       => 15.00,
                'stock'       => 46,
                'image'       => 'products/matcha-latte.jpg',
                'created_at'  => '2026-03-24 07:51:22',
                'updated_at'  => '2026-03-24 07:51:22',
            ],
            [
                'category_id' => 1,
                'name'        => 'Coffe Latte',
                'price'       => 10.00,
                'stock'       => 50,
                'image'       => 'products/coffe-latte.jpg',
                'created_at'  => '2026-03-24 07:51:22',
                'updated_at'  => '2026-03-24 07:51:22',
            ],
            [
                'category_id' => 2,
                'name'        => 'Strawberry Late',
                'price'       => 20.00,
                'stock'       => 30,
                'image'       => 'products/strawberry-late.jpg',
                'created_at'  => '2026-03-24 07:51:22',
                'updated_at'  => '2026-03-24 07:51:22',
            ],
            [
                'category_id' => 4,
                'name'        => 'Green Tea Latte',
                'price'       => 11.00,
                'stock'       => 50,
                'image'       => 'products/green-tea-latte.jpg',
                'created_at'  => '2026-03-24 07:51:22',
                'updated_at'  => '2026-03-24 07:51:22',
            ],
            [
                'category_id' => 1,
                'name'        => 'Espresso',
                'price'       => 10.00,
                'stock'       => 50,
                'image'       => 'products/espresso.jpg',
                'created_at'  => '2026-03-24 07:51:22',
                'updated_at'  => '2026-03-24 07:51:22',
            ],
            [
                'category_id' => 1,
                'name'        => 'Americano',
                'price'       => 15.00,
                'stock'       => 168,
                'image'       => 'products/americano.jpg',
                'created_at'  => '2026-03-24 07:51:22',
                'updated_at'  => '2026-03-24 07:51:22',
            ],
            [
                'category_id' => 1,
                'name'        => 'Ice Latte',
                'price'       => 10.00,
                'stock'       => 168,
                'image'       => 'products/ice-latte.jpg',
                'created_at'  => '2026-03-24 07:51:22',
                'updated_at'  => '2026-03-24 07:51:22',
            ],
            [
                'category_id' => 1,
                'name'        => 'Freddo',
                'price'       => 12.00,
                'stock'       => 168,
                'image'       => 'products/freddo.jpg',
                'created_at'  => '2026-03-24 07:51:22',
                'updated_at'  => '2026-03-24 07:51:22',
            ],
            [
                'category_id' => 7,
                'name'        => 'Chicken Burger',
                'price'       => 20.00,
                'stock'       => 168,
                'image'       => 'products/chicken-burger.jpg',
                'created_at'  => '2026-03-24 07:51:22',
                'updated_at'  => '2026-03-24 07:51:22',
            ],
            [
                'category_id' => 1,
                'name'        => 'Cream Orange',
                'price'       => 12.00,
                'stock'       => 168,
                'image'       => 'products/cream-orange.jpg',
                'created_at'  => '2026-03-24 07:51:22',
                'updated_at'  => '2026-03-24 07:51:22',
            ],
        ]);

        // ── Users ─────────────────────────────────────────────────────────────
        DB::table('users')->insert([
            [
                'name'              => 'Da Panha',
                'email'             => 'admin@pos.com',
                'email_verified_at' => null,
                'password'          => Hash::make('password'),
                'role'              => 'admin',
                'image'             => null,
                'remember_token'    => null,
                'created_at'        => '2026-03-24 07:51:21',
                'updated_at'        => '2026-03-24 07:51:21',
            ],
            [
                'name'              => 'Staff Member',
                'email'             => 'staff@pos.com',
                'email_verified_at' => null,
                'password'          => Hash::make('password'),
                'role'              => 'staff',
                'image'             => null,
                'remember_token'    => null,
                'created_at'        => '2026-03-24 07:51:21',
                'updated_at'        => '2026-03-24 07:51:21',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     * Re-truncates the real data tables (leaves them empty on rollback).
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::table('customers')->truncate();
        DB::table('team_members')->truncate();
        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};
