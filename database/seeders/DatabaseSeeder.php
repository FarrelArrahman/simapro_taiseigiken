<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            VendorSeeder::class,
            UnitSeeder::class,
            UserSeeder::class,
            DesignatorSeeder::class,
            ProjectSeeder::class,
            ProjectDesignatorSeeder::class,
            ProjectEvaluationSeeder::class,
            ProjectDesignatorProgressUpdateSeeder::class,
        ]);
    }
}
