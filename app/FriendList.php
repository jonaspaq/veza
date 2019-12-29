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

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
