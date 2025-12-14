<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_authenticated_to_view_posts(): void
    {
        Sanctum::actingAs(User::factory() -> create());

        $response = $this->get("/api/v1/posts");

        $response->assertStatus(200);
    }

    public function test_user_authorized_to_update_post(): void {
        $user = User::factory() -> create();
        Sanctum::actingAs($user);

        $response = $this -> postJson("/api/v1/posts", ["title" => "Test Post", "content" => "Test Post"]);
        // $post = $user -> posts() -> create(["title" => "Test Post", "content" => "Test Post"]);

        $id = $response -> json("id");

        $user2 = User::factory() -> create();
        Sanctum::actingAs($user2);

        $assertedResponse = $this -> putJson("/api/v1/posts/$id", ["title" => "Updated Post"]);

        $assertedResponse -> assertStatus(403);
    }
}
