<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use App\Models\Status;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => function(){ return factory(User::class)->create(); },
        'status_id' => function(){ return factory(Status::class)->create(); },
        'body' => $faker->paragraph
    ];
});
