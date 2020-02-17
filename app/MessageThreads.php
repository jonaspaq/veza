<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageThreads extends Model
{
    protected $table = 'message_threads';
    protected $guarded = [];

    public function messages()
    {
        return $this;
    }
}
