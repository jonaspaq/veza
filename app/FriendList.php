<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendList extends Model
{
    protected $table = 'friend_list';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id', 'status'
    ];

    public function sender()
    {
        return $this->belongsTo('App\User', 'user_one');
    }

    public function reciever()
    {
        return $this->belongsTo('App\User', 'user_two');
    }
}
