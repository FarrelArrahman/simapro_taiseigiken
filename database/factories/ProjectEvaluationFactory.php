<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectEvaluation>
 */
class ProjectEvaluationFactory extends Factory
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
            'evaluated_by' => fake()->numberBetween(1, User::whereIn('role', ['Admin', 'Project Head'])->count()),
            'evaluation' => fake()->sentence(12),
        ];
    }
}
