<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
             'title' => $faker->title,
             'content' => $faker->text,
             'thumbnail' => $faker->image(),
             'user_id' => function(){
              return User::all()->random();
             }
    ];
});
