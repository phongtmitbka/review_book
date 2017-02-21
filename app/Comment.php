<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $table = 'comments';

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store(Request $request, $id)
    {
        $this->review_id = $id;
        $this->user_id = Auth::user()->id;
        $this->comment = $request->comment;
        $this->save();
    }

    public function rules()
    {
        return [
            'comment' => 'required:name'
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => trans('front.error.comment_require')
        ];
    }
}
