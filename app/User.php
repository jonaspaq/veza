<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    // Relationships
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function friendSent()
    {
        return $this->hasMany('App\FriendList', 'user_one');
    }

    public function friendReceived()
    {
        return $this->hasMany('App\FriendList', 'user_two');
    }

    public function message_threads()
    {
        return $this->hasMany('App\MessageThread');
    }

}
