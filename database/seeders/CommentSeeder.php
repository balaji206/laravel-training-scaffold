<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use App\Models\Comment;
class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = Task::all();
        $users = User::all();

        Comment::factory(50)->make()->each(function ($comment) use ($tasks, $users) {
            $comment->task_id = $tasks->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}