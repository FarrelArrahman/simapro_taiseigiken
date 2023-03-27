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
            'name' => '[TEST] Super Admin',
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

        User::create([
            'national_identity_number' => '0000000000000001',
            'name' => '[TEST] Manager',
            'email' => 'manager@simapro.taiseigiken.test',
            'password' => bcrypt('123'),
            'remember_token' => NULL,
            'gender' => 'Male',
            'address' => NULL,
            'phone_number' => NULL,
            'role' => RoleEnum::Manager,
            'status' => StatusEnum::Active,
            'profile_picture' => fake()->imageUrl(category: 'person'),
            'locale' => 'id',
        ]);

        User::create([
            'national_identity_number' => '0000000000000002',
            'name' => '[TEST] Project Head',
            'email' => 'projecthead@simapro.taiseigiken.test',
            'password' => bcrypt('123'),
            'remember_token' => NULL,
            'gender' => 'Male',
            'address' => NULL,
            'phone_number' => NULL,
            'role' => RoleEnum::ProjectHead,
            'status' => StatusEnum::Active,
            'profile_picture' => fake()->imageUrl(category: 'person'),
            'locale' => 'id',
        ]);

        User::create([
            'national_identity_number' => '0000000000000003',
            'name' => '[TEST] Worker',
            'email' => 'worker@simapro.taiseigiken.test',
            'password' => bcrypt('123'),
            'remember_token' => NULL,
            'gender' => 'Male',
            'address' => NULL,
            'phone_number' => NULL,
            'role' => RoleEnum::Worker,
            'status' => StatusEnum::Active,
            'profile_picture' => fake()->imageUrl(category: 'person'),
            'locale' => 'id',
        ]);

        User::factory(100)->create();
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
