<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    $updated_at = $faker->dateTimeThisMonth();

    return [
        'title' => $faker->sentence(6),
        'body' => $faker->text(),
        'user_id' => $faker->numberBetween(1, 15),
        'category_id' => $faker->numberBetween(1, 4),
        'updated_at' => $updated_at,
        'created_at' => $faker->dateTimeThisYear($updated_at),
    ];
});
