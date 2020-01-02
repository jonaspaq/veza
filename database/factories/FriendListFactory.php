<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FriendList;
use Faker\Generator as Faker;

$factory->define(FriendList::class, function (Faker $faker) {
    return [
        'user_one' => rand(1, 100),
        'status' => 'pending'
    ];
});
