<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use App\User;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'user_id_from' => factory(App\User::class),
        'user_id_to' => factory(App\User::class),
        'subject' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});
