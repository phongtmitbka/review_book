<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBook extends Model
{
    protected $table = 'user_book';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function storeVote(Request $request, $id)
    {
        $this->rate = $request->rate;
        $this->save();
    }

    public function createFavorite($id)
    {
        $this->user_id = Auth::user()->id;
        $this->book_id = $id;
        $this->favorite = 1;
        $this->save();
    }

    public function favorite($id)
    {
        $this->favorite = 1;
        $this->save();
    }

    public function cancelFavorite($id)
    {
        $this->favorite = 0;
        $this->save();
    }

    public function updateStatus(Request $request)
    {
        $this->read_book_status = $request->status;
        $this->save();
    }

    public function createUserBook(Request $request, $book_id)
    {
        $this->user_id = Auth::user()->id;
        $this->book_id = $book_id;
        $this->rate = $request->rate;
        $this->read_book_status = $request->status;
        $this->save();
    }
}
