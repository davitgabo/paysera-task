<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!DB::table('products')->exists()) {
            $products = [
                    ['name' => 'laptop', 'price' => 1200],
                    ['name' => 'smartphone', 'price' => 900],
                    ['name' => 'tablet', 'price' => 600],
                    ['name' => 'headphones', 'price' => 150],
                    ['name' => 'gaming console', 'price' => 400],
                    ['name' => 'router', 'price' => 80],
                    ['name' => 'external hard drive', 'price' => 200],
                    ['name' => 'printer', 'price' => 300],
                    ['name' => 'monitor', 'price' => 250],
                    ['name' => 'keyboard', 'price' => 100],
                    ['name' => 'mouse', 'price' => 50],
                    ['name' => 'VR headset', 'price' => 500],
                    ['name' => 'camera', 'price' => 700],
                    ['name' => 'smartwatch', 'price' => 300],
                    ['name' => 'speakers', 'price' => 120],
                    ['name' => 'microphone', 'price' => 150],
                    ['name' => 'graphics tablet', 'price' => 400],
                    ['name' => 'projector', 'price' => 600],
                    ['name' => 'drone', 'price' => 800],
                    ['name' => 'fitness tracker', 'price' => 150]
                ];

            DB::table('products')->insert($products);
        }
    }
}
