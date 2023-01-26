<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
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
        User::create([
            'national_identity_number' => '0000000000000000',
            'name' => 'Super Admin',
            'email' => 'superadmin@simapro.taiseigiken.test',
            'password' => bcrypt('123'),
            'remember_token' => NULL,
            'gender' => 'Male',
            'address' => NULL,
            'phone_number' => NULL,
            'role' => RoleEnum::Admin,
            'status' => StatusEnum::Active,
            'profile_picture' => fake()->imageUrl(category: 'person'),
            'locale' => 'id',
        ]);

        // User::factory(20)->create();
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
