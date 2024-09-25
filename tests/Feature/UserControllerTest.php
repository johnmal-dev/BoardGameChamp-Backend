<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_all_users_sorted_by_username()
    {
        $users = User::factory()->count(3)->create();

        $response = $this->get('/api/users');

        $expectedData = $users->sortBy('username')->values()->toArray();

        $response
            ->assertStatus(200)
            ->assertJson($expectedData);
    }

    /** @test */
    public function it_can_create_a_user()
    {
        $userData = [
            'username' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/api/users', $userData);

        $response
            ->assertStatus(201)
            ->assertJsonMissing(['password']);

        unset($userData['password']);

        $this->assertDatabaseHas('users', $userData);
    }

    /** @test */
    public function it_returns_an_error_if_required_input_is_missing()
    {
        $response = $this->post('/api/users', ['username' => 'testuser', 'email' => 'john@mail.com']);

        $response->assertStatus(400)
            ->assertJson(['error' => 'Username, email and password are required']);
    }

    /** @test */
    public function it_can_update_a_username()
    {
        $user = User::factory()->create([
            'username' => 'oldusername',
        ]);

        $this->assertDatabaseHas('users', ['id' => $user->id, 'username' => 'oldusername']);
        $response = $this->patch("/api/users/{$user->id}", ['username' => 'newusername']);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'username' => 'newusername']);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $response = $this->delete("/api/users/{$user->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function it_can_get_a_user()
    {
        $user = User::factory()->create();

        $response = $this->get("/api/users/{$user->id}");

        $response
            ->assertStatus(200)
            ->assertJson($user->toArray());
    }

    /** @test */
    public function it_returns_an_error_if_user_not_found()
    {
        $response = $this->get('/api/users/999');

        $response->assertStatus(404)
            ->assertJson(['error' => 'User not found']);
    }
}
