<?php

namespace Repositories;


use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $postRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->postRepository = new PostRepository();
    }

    public function testCreatePost()
    {
        // create data post
        $faker = Factory::create();
        $postData = [
            'title' => $faker->sentence,
            'content' => $faker->sentence,
            'user_id' => User::factory()->create()->id,
        ];
        $post = $this->postRepository->create($postData);
        // Check post created instance of Post
        $this->assertInstanceOf(Post::class, $post);
        // Check data post exists in the database
        $this->assertDatabaseHas('posts', $post->toArray());
    }
}
