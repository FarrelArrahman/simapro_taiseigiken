<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Designator>
 */
class DesignatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->words(2, true),
            'unit_id' => fake()->numberBetween(1, Unit::all()->count()),
            'material' => fake()->randomNumber(9),
            'services' => fake()->randomNumber(9),
            'description' => fake()->text(),
            'status' => fake()->randomElement(StatusEnum::activeCases()),
        ];
    }
}
