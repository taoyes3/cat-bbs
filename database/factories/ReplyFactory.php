<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {

    $topic_ids = \App\Models\Topic::all()->pluck('id')->all();
    $user_ids = \App\Models\User::all()->pluck('id')->all();
    $time = $faker->dateTimeThisMonth();

    return [
        'topic_id' => $faker->randomElement($topic_ids),
        'user_id' => $faker->randomElement($user_ids),
        'content' => $faker->sentence,
        'created_at' => $time,
        'updated_at' => $time,
    ];
});
