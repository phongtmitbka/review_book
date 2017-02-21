<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FollowOther extends Model
{
    protected $table = 'others_follows';
    public $timestamps = false;
    
    public function user_follow()
    {
        return $this->belongsTo(User::class, 'user_follow_id', 'id');
    }

    public function user_followed()
    {
        return $this->belongsTo(User::class, 'user_followed_id', 'id');
    }

    public function store($id)
    {
        $this->user_follow_id = Auth::user()->id;
        $this->user_followed_id = $id;
        $this->save();
    }
}
