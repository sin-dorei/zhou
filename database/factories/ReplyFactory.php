<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'content' => $faker->text(),
        'user_id' => $faker->numberBetween(1, 15),
        'topic_id' => $faker->numberBetween(1, 50),
    ];
});
