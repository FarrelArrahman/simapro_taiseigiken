<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'national_identity_number' => fake()->nik(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'role' => fake()->randomElement(['Admin', 'Project Head', 'Worker', 'Manager']),
            'status' => fake()->randomElement(StatusEnum::activeCases()),
            'profile_picture' => fake()->imageUrl(category: 'person')
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user is a project head.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function projectHeads()
    {
        return $this->state(function (array $attributes) {
            return [
                'role' => 'Project Head',
            ];
        });
    }
}
