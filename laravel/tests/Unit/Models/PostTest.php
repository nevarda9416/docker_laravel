<?php

namespace Tests\Unit\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_be_longs_to_user()
    {
        // Need to create UserFactory and PostFactory before test
        // Use factory to create user and post for test
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        // Check foreign key exists
        $this->assertEquals('user_id', $post->user()->getForeignKeyName());
        // Check instance of belongsTo
        $this->assertInstanceOf(BelongsTo::class, $post->user());
        // Check instance of User class
        $this->assertInstanceOf(User::class, $post->user);
    }
}
