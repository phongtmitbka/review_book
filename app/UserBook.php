<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBook extends Model
{
    protected $table = 'user_book';
    public $timestamps = false;

    public function book()
    {
    	return $this->belongsTo(Book::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
