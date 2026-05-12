<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_and_receive_a_token()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/login',[
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertOk()
        ->assertJsonStructure(['token']);
    }

    /** @test */
    public function authenticated_request_returns_user_projects()
    {
        $user = User::factory()->create();
        Project::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/projects');

        $response->assertOk()
        ->assertJsonCount(3,'data');
    }
}