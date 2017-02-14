<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    public $timestamps = false;

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function book_user()
    {
    	return $this->hasOne(UserBook::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
