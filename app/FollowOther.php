<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowOther extends Model
{
    public function user_follow()
    {
    	return $this->belongsTo(User::class, 'user_follow_id', 'id');
    }

    public function user_followed()
    {
    	return $this->belongsTo(User::class, 'user_followed_id', 'id');
    }
}
