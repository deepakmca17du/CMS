<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use App\Category;
use App\User;
use Illuminate\Http\UploadedFile;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'content'=>$faker->paragraph,
        'image'=>UploadedFile::fake()->image('3.jpg'),
        'category_id'=>function(){
            return factory(Category::class)->create()->id;
        },
        'user_id'=>function () {
            return factory(User::class)->create()->id;
        },
        'deleted_at' => null,
        'published_at'=>$faker->dateTime('now'),
        'is_approved'=>true
    ];
});
