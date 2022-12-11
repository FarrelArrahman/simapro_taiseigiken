<?php

namespace Database\Factories;

use App\Enums\StatusEnum;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $timeOfContract = fake()->numberBetween(1, 365);
        $beginDate = fake()->numberBetween(1, 365);

        return [
            'project_code' => fake()->unique()->regexify('[A-Za-z0-9]{10}'),
            'project_name' => fake()->sentence(),
            'time_of_contract' => $timeOfContract . ' ' . ($timeOfContract < 2 ? 'day' : 'days'),
            'drm_value' => fake()->randomNumber(9),
            'project_head_id' => User::whereIn('role', ['Admin', 'Project Head'])->inRandomOrder()->first()->id,
            'vendor_id' => fake()->numberBetween(1, Vendor::all()->count()),
            'begin_date' => fake()->dateTimeBetween(startDate: "-" . $beginDate . " days"),
            'finish_date' => fake()->dateTimeBetween(startDate: 'now', endDate: "+" . $timeOfContract . " days"),
            'status' => fake()->randomElement(StatusEnum::approvalCases()),
        ];
    }
}
