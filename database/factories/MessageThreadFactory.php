<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MessageThread;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(MessageThread::class, function (Faker $faker) {
    return [
        'user_one' => rand(1, 50),
        'user_one' => rand(1, 50),
        'last_activity' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});
