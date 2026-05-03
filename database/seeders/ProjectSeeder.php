<?php

namespace Database\Seeders;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
       
        Project::factory()->count(10)->create();
    }
}