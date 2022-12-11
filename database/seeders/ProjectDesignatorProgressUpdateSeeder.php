<?php

namespace Database\Seeders;

use App\Models\ProjectDesignatorProgressUpdate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectDesignatorProgressUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectDesignatorProgressUpdate::factory(60)->create();
    }
}
