<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;

class ProjectCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_view_their_projects()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/projects');

        $response->assertOk()
        ->assertSee($project->name);
    }

    /** @test */
    public function authenticated_user_can_create_a_project()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/projects', [
            'name' => 'New Project',
            'description' => 'Project description',
            'status' => 'active',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('projects', [
            'name' => 'New Project',    
        ]);
    }

    /** @test */
    public function user_cannot_update_another_users_project()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $project = Project::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($otherUser)->put("/projects/{$project->id}", [
            'name' => 'Updated Project',
            'description' => 'Project description',
            'status' => 'active',
        ]);

        $response->assertForbidden();
    }

    public function owner_can_update_project()
    {
        $user = User::factory()->create();

$project = Project::factory()->create([
    'user_id' => $user->id,
]);

$this->actingAs($user);

$response = $this->put("/projects/{$project->id}", [
    'name' => 'Updated Project',
    'description' => 'Updated',
]);

$response->assertRedirect();

$this->assertDatabaseHas('projects', [
    'name' => 'Updated Project',
]);
    }

    public function owner_can_delete_project()
    {
        $user = User::factory()->create();

$project = Project::factory()->create([
    'user_id' => $user->id,
]);

$this->actingAs($user);

$response = $this->delete("/projects/{$project->id}");

$response->assertRedirect();

$this->assertDatabaseMissing('projects', [
    'id' => $project->id,
]);
    }
}