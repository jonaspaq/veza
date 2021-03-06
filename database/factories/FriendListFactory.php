<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FriendList;
use Faker\Generator as Faker;

$factory->define(FriendList::class, function (Faker $faker) {
    $arrayToRandom = ['pending', 'friends'];
    $chosen = array_rand($arrayToRandom, 1);
    return [
        'user_one' => rand(1, 50),
        'user_two' => rand(1, 50),
        'status' => $arrayToRandom[$chosen]
    ];
});
