<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
           'name' => Str::random(5),
    ];
});
