<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'phone'             => fake()->phoneNumber(),
            'remember_token'    => Str::random(10),
            'role_id'           => Role::where('name', 'user')->first()?->id ?? 3,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn() => ['email_verified_at' => null]);
    }

    public function admin(): static
    {
        return $this->state(fn() => [
            'role_id' => Role::where('name', 'admin')->first()?->id ?? 1,
        ]);
    }

    public function editor(): static
    {
        return $this->state(fn() => [
            'role_id' => Role::where('name', 'editor')->first()?->id ?? 2,
        ]);
    }
}
