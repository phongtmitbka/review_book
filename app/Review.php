<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $table = 'reviews';
    public function book()
    {
    	return $this->belongsTo(Book::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }
}
