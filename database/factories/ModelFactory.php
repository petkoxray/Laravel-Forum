<?php

use Faker\Generator as Faker;


$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Thread::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\Models\User')->create()->id;
        },
        'channel_id' => function() {
            return factory('App\Models\Channel')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\Models\User')->create()->id;
        },
        'thread_id' => function () {
            return factory('App\Models\Thread')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});

$factory->define(App\Models\Channel::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => $name
    ];
});
