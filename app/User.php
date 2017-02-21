<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

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
        return $this->belongsToMany(Book::class, 'user_book');
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
        return $this->hasMany(FollowOther::class, 'user_followed_id', 'id');
    }

    public function user_followeds()
    {
        return $this->hasMany(FollowOther::class, 'user_follow_id', 'id');
    }

    public function rules($rulesName)
    {
        if ($rulesName == 'store')
        {
            return [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'pass' => 'required|min:6|max:32',
                'repass' => 'required|same:pass'
            ];
        }
        elseif ($rulesName == 'update')
        {
            return [
                'name' => 'required|min:3'
            ];
        }
        else
        {
            return [
                'pass' => 'required|min:6|max:32',
                'repass' => 'required|same:pass'
            ];
        }
    }

    public function messages()
    {
        return [
            'email.required' => trans('admin.error.email_require'),
            'email.email' => trans('admin.error.email'),
            'email.unique' => trans('admin.error.email_unique'),
            'name.required' => trans('admin.error.name_require'),
            'name.min' => trans('admin.error.name_min'),
            'pass.required' => trans('admin.error.pass_require'),
            'pass.min' => trans('admin.error.pass_min'),
            'pass.max' => trans('admin.error.pass_max'),
            'repass.required' => trans('admin.error.repass_require'),
            'repass.same' => trans('admin.error.repass_same')
        ];
    }

    public function store(Request $request)
    {
        $this->name = isset($request->name) ? $request->name : $this->name;
        $this->password = isset($request->pass) ? bcrypt($request->pass) : $this->password;
        $this->email = $request->email;
        $this->level =  isset($request->level) ? $request->level : (isset($this->level) ? $this->level : 2);
        $this->language = $request->language;
        $this->save();
    }
}
