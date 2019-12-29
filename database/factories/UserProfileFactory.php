<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
              'address' => $faker->address,
              'photo' => $faker->image(),
              'phone' => $faker->phoneNumber,
              'user_id' => function()
                {
                    return User::all()->random()->unique();
                }
    ];
});
