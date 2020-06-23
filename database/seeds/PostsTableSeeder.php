<?php

use App\Tag;
use App\Post;
use App\Category;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name'=>'News'
        ]);

        $category2 = Category::create([
            'name'=>'Marketing'
        ]);

        $category3 = Category::create([
            'name'=>'Partnership'
        ]);

        $author1 = User::create([
            'name'=>'Deepak Yadav',
            'email'=>'deepak03yadav@gmail.com',
            'password'=>Hash::make('password')
        ]);

        $author2 = User::create([
            'name'=>'Kachuipam Rungsung',
            'email'=>'kachuipam.mca17.du@gmail.com',
            'password'=>Hash::make('password')
        ]);

        $post1 = Post::create([
           'title'=>'We relocated our office to a new designed garage',
           'description'=>'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...',
           'content'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
           'category_id'=>$category1->id,
            'image'=>'posts/1.jpg',
            'user_id'=>$author1->id
        ]);

        $post2 = $author2->posts()->create([
            'title'=>'Top 5 brilliant content marketing strategies',
            'description'=>'1914 translation by H. Rackham',
            'content'=>'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?',
            'category_id'=>$category2->id,
            'image'=>'posts/2.jpg'
        ]);

        $post3 = $author1->posts()->create([
            'title'=>'Best practices for minimalist design with example',
            'description'=>'What is Lorem Ipsum?',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum',
            'category_id'=>$category3->id,
            'image'=>'posts/3.jpg'
        ]);

        $tag1 = Tag::create([
            'name'=>'job'
        ]);

        $tag2 = Tag::create([
            'name'=>'customers'
        ]);

        $tag3 = Tag::create([
            'name'=>'record'
        ]);

        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag2->id,$tag3->id]);
        $post3->tags()->attach([$tag1->id,$tag3->id]);

    }
}
