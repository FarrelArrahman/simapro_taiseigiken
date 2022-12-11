<?php

namespace Database\Seeders;

use App\Models\ProjectDesignator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectDesignatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectDesignator::factory(30)->create();
    }
}
