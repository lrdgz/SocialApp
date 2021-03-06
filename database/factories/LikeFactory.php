<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use App\Models\Status;
use \App\User;
use Faker\Generator as Faker;

$factory->define(Like::class, function (Faker $faker) {
    return [
        'user_id' => function(){ return factory(User::class)->create(); },
//        'status_id' => function(){ return factory(Status::class)->create(); },
    ];
});
