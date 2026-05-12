<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class RelationshipTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function project_has_many_tasks()
    {
        // TODO Day 12: create project, attach tasks, assert $project->tasks->count() === N
        $project  = Project::factory()->create();
        Task::factory()->count(3)->create([
            'project_id' => $project->id,
        ]);

        $this->assertEquals(3,$project->tasks->count());
    }

    /** @test */
    public function user_belongs_to_many_projects()
    {
        // TODO Day 12: assert $user->projects relationship works (pivot table)
        $user = User::factory()->create();
        Project::factory()->count(2)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals(2,$user->projects->count());
    }
}