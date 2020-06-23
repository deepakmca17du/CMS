<?php

namespace Tests\Unit;

use App\Category;
use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use RefreshDatabase, WithFaker;

    /** @test  */
    public function users_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('users', [
                'id','name', 'email', 'email_verified_at', 'password'
            ]), 1);
    }
    /** @test  */
    public function add_new_users_to_database()
    {
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@test.com';
        $user->password = 'test';

        $savedUser = $user->save();

        $this->assertTrue($savedUser);
    }

    /** @test */
    public function a_user_has_many_posts()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();
        $post = factory(Post::class)->create(['user_id' => $user->id, 'category_id'=>$category->id])->toArray();

        // Method 1: Count that a post comments collection exists.
        $this->assertEquals(1, $user->posts->count());

        // Method 2: Comments are related to posts and is a collection instance.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->posts);
    }
}
