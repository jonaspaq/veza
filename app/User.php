<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;
use App\Traits\CustomEmailVerification;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, CustomEmailVerification;

    protected $guarded = ['password_confirmation'];

    protected $hidden = [
        'password'
    ];

    public function fullName()
    {
        if($this->middle_name)
            return $this->first_name." ".$this->middle_name." ".$this->last_name;

        return $this->first_name." ".$this->last_name;
    }

    public function primary_email()
    {
        return $this->emails()->where('is_primary', 1);
    }

    // Relationships
    public function emails()
    {
        return $this->hasMany('App\UserEmail');
    }

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

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

}
