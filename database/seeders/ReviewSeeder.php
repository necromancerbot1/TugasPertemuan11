<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users    = User::whereHas('role', fn($q) => $q->where('name', 'user'))->get();
        $products = Product::all();

        $comments = [
            'Produk bagus, sesuai deskripsi!',
            'Pengiriman cepat, packing aman.',
            'Kualitas sangat memuaskan, recommended!',
            'Harga terjangkau untuk kualitas segini.',
            'Sudah sesuai ekspektasi, terima kasih.',
            'Produk original, tidak mengecewakan.',
            'Barang sampai dalam kondisi baik.',
            'Seller ramah dan fast respon.',
            'Lumayan bagus untuk harga segini.',
            'Akan beli lagi di sini.',
        ];

        foreach ($users->take(10) as $user) {
            // Setiap user review 5 produk berbeda
            $reviewedProducts = $products->random(5);
            foreach ($reviewedProducts as $product) {
                Review::firstOrCreate(
                    ['user_id' => $user->id, 'product_id' => $product->id],
                    [
                        'rating'  => rand(3, 5),
                        'comment' => $comments[array_rand($comments)],
                    ]
                );
            }
        }
    }
}
