<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 200)
            ->create()
            ->each(function ($user) {
                $user->posts()->createMany(factory(App\Post::class, 100)->make()->toArray());
            });
    }
}
