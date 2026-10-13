<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users    = User::whereHas('role', fn($q) => $q->where('name', 'user'))->get();
        $products = Product::active()->inStock()->get();
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];

        foreach ($users->take(8) as $user) {
            // Setiap user buat 2-3 order
            $orderCount = rand(2, 3);
            for ($i = 0; $i < $orderCount; $i++) {
                $items      = $products->random(rand(1, 4));
                $totalPrice = 0;
                $orderCode  = 'ORD-' . strtoupper(Str::random(8));

                $order = Order::create([
                    'user_id'          => $user->id,
                    'order_code'       => $orderCode,
                    'total_price'      => 0, // diupdate setelah items
                    'status'           => $statuses[array_rand($statuses)],
                    'shipping_address' => 'Jl. Contoh No. ' . rand(1, 100) . ', Kota Medan, Sumatera Utara',
                ]);

                foreach ($items as $product) {
                    $qty      = rand(1, 3);
                    $subtotal = $product->price * $qty;
                    $totalPrice += $subtotal;

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'quantity'   => $qty,
                        'unit_price' => $product->price,
                        'subtotal'   => $subtotal,
                    ]);
                }

                $order->update(['total_price' => $totalPrice]);
            }
        }
    }
}
