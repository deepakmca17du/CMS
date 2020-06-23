<?php

namespace Tests\Feature;

use App\Category;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Http\UploadedFile;

class BlogPostTest extends TestCase
{
    use RefreshDatabase, withFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function it_should_forbid_an_unauthenticated_user_to_create_a_blog_post()
    {
        $response = $this->json('POST', '/posts', [
            'title' => 'Test Post',
            'description' => 'Hey, Welcome to Laravel Testing',
            'content' => 'Here we bring you Feature tests of Laravel Testing',
            'image'=>'posts/3.jpg',
            'category'=>1
        ]);
        // or $this->postJson in Laravel 6.x

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_should_allow_an_authenticated_user_to_view_a_blog_post()
    {
        $user = factory(User::class)->create();

        // Guests
        $this->get('/posts/create')->assertRedirect('login');

        // Users
        $response = $this->actingAs($user)->get('/posts');
        $response->assertOk();
    }

    /** @test */
    public function it_should_fail_validation_when_creating_a_blog_post_without_category()
    {
        $this->withoutMiddleware();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->json('POST', route('posts.store'), [
                'title' => 'TestPost',
                'description' => 'Hey, Welcome to Laravel Testing',
                'content' => 'Here we bring you Feature tests of Laravel Testing',
                'image'=>UploadedFile::fake()->image('3.jpg'),
            ]);

        /**422 Unprocessable Entity :  means that the data you posted using AJAX was invalid for this request.
         * This happens when you have a Request Rules setup.
         * Laravel validates each request before it passes onto your controller method.
         * The issue may be in your data or the request rule used for the request */
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('category');
    }
    /** @test */
    public function a_new_post_can_be_created()
    {
        $user = factory(User::class)->create();
        $attributes = factory(Post::class)->create(['user_id'=>$user->id])->getRawOriginal();

        $this->actingAs($user)
            ->followingRedirects()
            ->post(route('posts.store'),$attributes)
            ->assertSee($attributes['title']);

        $this->assertCount(1,Post::all());
    }
}
