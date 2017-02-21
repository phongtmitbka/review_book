<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookRequest extends Model
{
    protected $table = 'book_requests';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store(Request $request)
    {
        $this->title = $request->title;
        $this->user_id = Auth::user()->id;
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

    public function statusRequest(Request $request, $id)
    {
        $this->status = $request->status;
        $this->save();
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('admin.error.title_require'),
            'title.min' => trans('admin.error.title_min')
        ];
    }

    public function saveStatus($status)
    {
        $this->status = $status;
        $this->save();
    }
}
