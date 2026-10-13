<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik',        'description' => 'Gadget, laptop, smartphone, dan aksesoris elektronik'],
            ['name' => 'Fashion Pria',      'description' => 'Pakaian, sepatu, dan aksesoris pria'],
            ['name' => 'Fashion Wanita',    'description' => 'Pakaian, sepatu, dan aksesoris wanita'],
            ['name' => 'Makanan & Minuman', 'description' => 'Produk makanan, minuman, dan suplemen'],
            ['name' => 'Olahraga',          'description' => 'Peralatan olahraga dan kebugaran'],
            ['name' => 'Rumah & Taman',     'description' => 'Furnitur, dekorasi, dan perlengkapan rumah'],
            ['name' => 'Buku & Edukasi',    'description' => 'Buku, alat tulis, dan media pembelajaran'],
            ['name' => 'Kesehatan',         'description' => 'Produk kesehatan, skincare, dan kecantikan'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                array_merge($cat, ['slug' => Str::slug($cat['name'])])
            );
        }
    }
}
