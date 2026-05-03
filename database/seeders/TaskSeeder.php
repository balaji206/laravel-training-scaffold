<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
class TaskSeeder extends Seeder
{
    public function run(): void
    {

        $projects = Project::all();
        $users = User::all();

        Task::factory(30)->make()->each(function ($task) use ($projects, $users)
        {
            $task->project_id = $projects->random()->id;
            $task->assigned_to_id = $users->random()->id;
            $task->save();
        });
    }
}