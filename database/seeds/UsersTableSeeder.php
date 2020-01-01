<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Post;
use App\FriendList;

class UsersTableSeeder extends Seeder
{
    public $usersToSeed = 100;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, $this->usersToSeed)->create()
            ->each(function ($user) {
                // For each user created, create 5 Posts related to user
                $user->posts()->saveMany(factory(Post::class, 5))
                ->create([
                    'user_id' => $user->id
                ]);

                // For each user created, create 5 Incoming Friend Requests
                // $user->friendReceived()->saveMany(factory(FriendList::class, 3))
                // ->create([
                //     'user_two' => $user->id
                // ]);
            });
    }
}
