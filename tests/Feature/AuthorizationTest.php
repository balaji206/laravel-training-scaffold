<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_is_redirected_to_login_when_visiting_projects()
    {
        $response = $this->get('/projects');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function admin_can_access_admin_routes()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);
        

        $response = $this->actingAs($admin)->get('/projects');

        $response->assertOk();
    }
}