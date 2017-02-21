<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function store(Request $request, $id)
    {
        $this->user_id = Auth::user()->id;
        $this->book_id = $id;
        $this->review = $request->review;
        $this->save();
    }

    public function updateNumberLike($operator)
    {
        if ($operator == 'add')
            $this->number_like ++;
        else 
            $this->number_like --;
        
        $this->save();
    }

    public function rules()
    {
        return [
            'review' => 'required:name'
        ];
    }

    public function messages()
    {
        return [
            'review.required' => trans('front.error.review_require')
        ];
    }
}
