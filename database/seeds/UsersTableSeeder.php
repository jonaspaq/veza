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
        factory(User::class, 10)
            ->create()
            ->each(function ($user) {
                $user->posts()->createMany(factory(App\Post::class, 50)->make()->toArray());
            });
    }
}
