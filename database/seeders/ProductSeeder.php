<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Kemeja hijau',
                'price' => 40000,
                'category' => 'baju'
            ],
            [
                'name' => 'Celana jeans',
                'price' => 80000,
                'category' => 'celana'
            ],
            [
                'name' => 'Topi koboy',
                'price' => 15000,
                'category' => 'topi'
            ],
            [
                'name' => 'Sepatu running',
                'price' => 70000,
                'category' => 'sepatu'
            ],
        ];
        Product::insert($data);
    }
}
