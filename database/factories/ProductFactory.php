<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(rand(2, 4), true);

        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'name'        => ucwords($name),
            'slug'        => Str::slug($name) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'description' => fake()->paragraph(3),
            'price'       => fake()->randomElement([
                rand(10000, 99000),
                rand(100000, 999000),
                rand(1000000, 9999000),
            ]),
            'stock'       => fake()->numberBetween(0, 200),
            'is_active'   => fake()->boolean(90), // 90% kemungkinan aktif
        ];
    }

    public function active(): static
    {
        return $this->state(fn() => ['is_active' => true]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn() => ['stock' => 0]);
    }
}
