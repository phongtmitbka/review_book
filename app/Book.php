<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Book extends Model
{
    protected $table = 'books';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_book');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user_book()
    {
        return $this->hasOne(UserBook::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'author' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('admin.error.title_require'),
            'title.min' => trans('admin.error.title_min'),
            'author.required' => trans('admin.error.author_require'),
            'author.min' => trans('admin.error.author_min')
        ];
    }

    public function storeBook(Request $request)
    {
        $this->title = $request->title;
        $this->author = $request->author;
        $this->publish_date = $request->date;
        $this->number_pages = $request->pages;
        $this->category_id = $request->cate;
        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $file_extension = strtolower($file->getclientOriginalExtension());
            if ($file_extension == 'png' || $file_extension == 'jpg' || $file_extension == 'jpeg')
            {
                $name = $file->getClientOriginalName();
                $name = str_random(5)."_".$name;
                $this->image = $name;
                $file->move('image', $name);
            } else 
                $this->image = "notavailable.jpeg";
        } else 
            $this->image = "notavailable.jpeg";
            
        $this->save();
    }

    public function updateBook(Request $request)
    {
        $this->title = $request->title;
        $this->author = $request->author;
        $this->publish_date = $request->date;
        $this->number_pages = $request->pages;
        $this->category_id = $request->cate;
        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $file_extension = strtolower($file->getclientOriginalExtension());
            if ($file_extension == 'png' || $file_extension == 'jpg' || $file_extension == 'jpeg')
            {
                $name = $file->getClientOriginalName();
                $name = str_random(5)."_".$name;
                $this->image = $name;
                $file->move('image', $name);
            }
        }
            
        $this->save();
    }

    public function rate($book_id)
    {
        $rate = UserBook::where('book_id', $book_id)->where('rate', '<>', 0)->avg('rate');
        $this->rate = round($rate * 2)/2.0;

        $this->save();
    }
}
