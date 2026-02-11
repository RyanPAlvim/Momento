<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'username' => fake()->unique()->userName(),
            'phone' => fake()->phoneNumber(),
            'streak' => rand(0, 200),
            'max_streak'=> rand(100, 200),
            'weekly_day_goals' => rand(0,7),
            'daily_minutes_goal' => rand(20, 120),
            'secondary_activity' => fake()->randomElement(['Reading', 'Gym', 'Running', 'Yoga']),
            'is_private' => fake()->boolean(5),
            'role' => fake()->randomElement(['admin', 'user', 'vip']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
