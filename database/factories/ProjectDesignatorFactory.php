<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\Designator;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectDesignators>
 */
class ProjectDesignatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'project_id' => fake()->numberBetween(1, Project::all()->count()),
            'designator_id' => fake()->numberBetween(1, Designator::all()->count()),
            'designated_by' => fake()->numberBetween(1, User::whereIn('role', ['Admin', 'Project Head'])->count()),
            'amount' => fake()->numberBetween(500, 1000),
            'status' => fake()->randomElement(StatusEnum::completionCases()),
        ];
    }
}
