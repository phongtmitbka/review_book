<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Category extends Model
{
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function bookrequests()
    {
        return $this->hasMany(BookRequest::class);
    }

    public function store(Request $request)
    {
        $this->name = $request->cate;
        $this->save();
    }

    public function rules()
    {
        return [
            'cate' => 'required|unique:categories,name'
        ];
    }

    public function messages()
    {
        return [
            'cate.required' => trans('admin.error.cate_require'),
            'cate.unique' => trans('admin.error.cate_not_change')
        ];
    }
}
