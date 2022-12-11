<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();
        // User::factory()
        //     ->projectHeads()
        //     ->has(
        //         Project::factory()
        //         ->has(
        //             ProjectDesignator::factory()
        //             ->has(
        //                 ProjectDesignatorDocumentation::factory()->count(5)
        //             )
        //             ->for(
        //                 Designator::factory()->count(1)
        //             )
        //             ->count(4)
        //         )
        //         ->has(
        //             ProjectEvaluation::factory()->count(2)
        //         )
        //         ->count(3)
        //     )
        //     ->create();
    }
}
