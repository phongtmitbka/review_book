<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function user_book()
    {
        return $this->hasOne(UserBook::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function book_requests()
    {
        return $this->hasMany(BookRequest::class);
    }

    public function user_follows()
    {
        return $this->hasMany(FollowOther::class, 'user_follow_id', 'id');
    }

    public function user_followeds()
    {
        return $this->hasMany(FollowOther::class, 'user_followed_id', 'id');
    }
}
