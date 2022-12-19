<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\ProjectDesignator;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectDesignatorProgressUpdate>
 */
class ProjectDesignatorProgressUpdateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'project_designator_id' => fake()->numberBetween(1, ProjectDesignator::all()->count()),
            'content' => null,
            'type' => fake()->randomElement(['documentation', 'progress_update']),
            'value' => fake()->numberBetween(1, 100),
            'description' => fake()->text(),
            'comment' => fake()->text(),
            'commented_by' => User::whereIn('role', ['Admin', 'Project Head'])->inRandomOrder()->first()->id,
            'uploaded_by' => fake()->numberBetween(1, User::where('role', 'Worker')->count()),
            'status' => fake()->randomElement(StatusEnum::approvalCases()),
        ];
    }
}
