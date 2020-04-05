<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Message;

class MessageThread extends Model
{
    protected $table = 'message_threads';
    protected $guarded = [];


    public function messages()
    {
        return $this->morphMany('App\Message','messageable');
    }

    public function sender()
    {
        return $this->belongsTo('App\User', 'user_one');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User', 'user_two');
    }
}
