<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FriendList;
use Faker\Generator as Faker;

$factory->define(FriendList::class, function (Faker $faker) {
    $arrayToRandom = ['pending', 'friends'];
    $chosen = array_rand($arrayToRandom, 1);
    return [
        'user_one' => rand(1, 100),
        'status' => $arrayToRandom[$chosen]
    ];
});
