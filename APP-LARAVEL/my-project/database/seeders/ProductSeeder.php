<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Laptop Gamer',
            'model' => 'GTX-1500',
            'price' => 1500.00,
        ]);

        Product::create([
            'name' => 'Souris Gaming',
            'model' => 'X-123',
            'price' => 50.00,
        ]);

        Product::create([
            'name' => 'Clavier Mécanique',
            'model' => 'RGB-789',
            'price' => 100.00,
        ]);
    }
}
