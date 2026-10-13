<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Elektronik
            ['category' => 'Elektronik', 'name' => 'iPhone 15 Pro Max 256GB',         'price' => 21999000, 'stock' => 15],
            ['category' => 'Elektronik', 'name' => 'Samsung Galaxy S24 Ultra',         'price' => 19499000, 'stock' => 20],
            ['category' => 'Elektronik', 'name' => 'Laptop ASUS ROG Strix G16',        'price' => 25999000, 'stock' => 8],
            ['category' => 'Elektronik', 'name' => 'MacBook Air M2 8GB 256GB',         'price' => 18499000, 'stock' => 12],
            ['category' => 'Elektronik', 'name' => 'Xiaomi 14T Pro 512GB',             'price' => 8999000,  'stock' => 30],
            ['category' => 'Elektronik', 'name' => 'Sony WH-1000XM5 Headphone',        'price' => 4999000,  'stock' => 25],
            ['category' => 'Elektronik', 'name' => 'iPad Pro M4 11 inch WiFi',         'price' => 15999000, 'stock' => 10],
            ['category' => 'Elektronik', 'name' => 'Keyboard Mechanical Keychron K2',  'price' => 1299000,  'stock' => 40],
            ['category' => 'Elektronik', 'name' => 'Monitor LG 27 inch 4K IPS',        'price' => 7499000,  'stock' => 18],
            ['category' => 'Elektronik', 'name' => 'Mouse Logitech MX Master 3S',      'price' => 1599000,  'stock' => 50],

            // Fashion Pria
            ['category' => 'Fashion Pria', 'name' => 'Kemeja Oxford Slim Fit Navy',    'price' => 299000,   'stock' => 60],
            ['category' => 'Fashion Pria', 'name' => 'Celana Chino Panjang Abu',       'price' => 259000,   'stock' => 55],
            ['category' => 'Fashion Pria', 'name' => 'Sepatu Sneakers Putih Pria',     'price' => 449000,   'stock' => 40],
            ['category' => 'Fashion Pria', 'name' => 'Jaket Bomber Hitam Casual',      'price' => 399000,   'stock' => 35],
            ['category' => 'Fashion Pria', 'name' => 'Polo Shirt Premium Hitam',       'price' => 189000,   'stock' => 70],
            ['category' => 'Fashion Pria', 'name' => 'Topi Baseball Distro Original',  'price' => 129000,   'stock' => 80],
            ['category' => 'Fashion Pria', 'name' => 'Tas Ransel Laptop 15 inch',      'price' => 349000,   'stock' => 45],

            // Fashion Wanita
            ['category' => 'Fashion Wanita', 'name' => 'Dress Floral Midi Casual',     'price' => 279000,   'stock' => 50],
            ['category' => 'Fashion Wanita', 'name' => 'Blouse Satin Pastel Pink',     'price' => 219000,   'stock' => 60],
            ['category' => 'Fashion Wanita', 'name' => 'Sepatu Heels Stiletto 7cm',    'price' => 389000,   'stock' => 30],
            ['category' => 'Fashion Wanita', 'name' => 'Tas Tote Bag Canvas Kulit',    'price' => 459000,   'stock' => 25],
            ['category' => 'Fashion Wanita', 'name' => 'Celana Kulot Wanita Hitam',    'price' => 199000,   'stock' => 65],
            ['category' => 'Fashion Wanita', 'name' => 'Hijab Voal Premium Motif',     'price' => 89000,    'stock' => 120],

            // Makanan & Minuman
            ['category' => 'Makanan & Minuman', 'name' => 'Kopi Arabika Gayo 500gr',   'price' => 129000,   'stock' => 100],
            ['category' => 'Makanan & Minuman', 'name' => 'Madu Asli Hutan 500ml',     'price' => 159000,   'stock' => 80],
            ['category' => 'Makanan & Minuman', 'name' => 'Coklat Dark 85% Lindt',     'price' => 89000,    'stock' => 150],
            ['category' => 'Makanan & Minuman', 'name' => 'Granola Oat Almond 400gr',  'price' => 79000,    'stock' => 90],
            ['category' => 'Makanan & Minuman', 'name' => 'Teh Hijau Organik 100gr',   'price' => 59000,    'stock' => 120],
            ['category' => 'Makanan & Minuman', 'name' => 'Protein Whey Isolate 1kg',  'price' => 499000,   'stock' => 40],

            // Olahraga
            ['category' => 'Olahraga', 'name' => 'Sepatu Running Nike Air Zoom',       'price' => 1599000,  'stock' => 25],
            ['category' => 'Olahraga', 'name' => 'Matras Yoga Anti Slip 6mm',          'price' => 299000,   'stock' => 50],
            ['category' => 'Olahraga', 'name' => 'Dumbbell Set Adjustable 20kg',       'price' => 899000,   'stock' => 20],
            ['category' => 'Olahraga', 'name' => 'Jersey Futsal Drifit Custom',        'price' => 179000,   'stock' => 60],
            ['category' => 'Olahraga', 'name' => 'Smartwatch Garmin Forerunner 165',   'price' => 3999000,  'stock' => 15],

            // Rumah & Taman
            ['category' => 'Rumah & Taman', 'name' => 'Kursi Gaming Ergonomis Hitam',  'price' => 2499000,  'stock' => 12],
            ['category' => 'Rumah & Taman', 'name' => 'Lampu LED Aesthetic Kamar',     'price' => 149000,   'stock' => 80],
            ['category' => 'Rumah & Taman', 'name' => 'Pot Tanaman Keramik Putih',     'price' => 89000,    'stock' => 100],
            ['category' => 'Rumah & Taman', 'name' => 'Rak Buku Minimalis 5 Tingkat',  'price' => 799000,   'stock' => 20],
            ['category' => 'Rumah & Taman', 'name' => 'Diffuser Aromaterapi Kayu',     'price' => 349000,   'stock' => 35],

            // Buku & Edukasi
            ['category' => 'Buku & Edukasi', 'name' => 'Atomic Habits - James Clear',  'price' => 119000,   'stock' => 60],
            ['category' => 'Buku & Edukasi', 'name' => 'Clean Code - Robert Martin',   'price' => 189000,   'stock' => 40],
            ['category' => 'Buku & Edukasi', 'name' => 'The Pragmatic Programmer',     'price' => 199000,   'stock' => 35],
            ['category' => 'Buku & Edukasi', 'name' => 'Belajar Laravel 11 Lengkap',   'price' => 159000,   'stock' => 55],
            ['category' => 'Buku & Edukasi', 'name' => 'Buku Matematika Diskrit',      'price' => 139000,   'stock' => 45],

            // Kesehatan
            ['category' => 'Kesehatan', 'name' => 'Vitamin C 1000mg 30 Tablet',        'price' => 79000,    'stock' => 200],
            ['category' => 'Kesehatan', 'name' => 'Serum Niacinamide 10% 30ml',        'price' => 129000,   'stock' => 150],
            ['category' => 'Kesehatan', 'name' => 'Sunscreen SPF50 PA+++ 50ml',        'price' => 149000,   'stock' => 120],
            ['category' => 'Kesehatan', 'name' => 'Masker Sheet Collagen Korea',       'price' => 25000,    'stock' => 300],
            ['category' => 'Kesehatan', 'name' => 'Minyak Ikan Omega 3 Fish Oil',      'price' => 99000,    'stock' => 180],
            ['category' => 'Kesehatan', 'name' => 'Hand Sanitizer Gel 500ml',          'price' => 45000,    'stock' => 250],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->first();
            if (!$category) continue;

            $slug = Str::slug($item['name']);
            // Pastikan slug unik
            $count = Product::where('slug', 'like', $slug . '%')->count();
            if ($count > 0) $slug .= '-' . ($count + 1);

            Product::firstOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $category->id,
                    'name'        => $item['name'],
                    'slug'        => $slug,
                    'description' => 'Produk berkualitas tinggi: ' . $item['name'] . '. Terjamin kualitas dan keasliannya.',
                    'price'       => $item['price'],
                    'stock'       => $item['stock'],
                    'is_active'   => true,
                ]
            );
        }
    }
}
