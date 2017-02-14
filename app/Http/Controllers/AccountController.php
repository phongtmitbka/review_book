<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class AccountController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => trans('admin.error.emailrequire'),
                'pass.required' => trans('admin.error.passrequire'),
            ]);
        if (Auth::attempt(['email' => $request->email,'password' => $request->password]))
        {
            return redirect('admin/cate');
        }
        else
        {
            return redirect('admin')->with('message', trans('admin.error.loginfail'));
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('admin');
    }

    public function edit($id)
    {
        $user = Auth::user();
        return view('admin.user.change_pass', ['user' => $user]);
    } 

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $this->validate($request,
            [
                'pass' => 'required|min:6|max:32',
                'rePass' => 'required|same:pass',
            ],
            [
                'pass.required' => trans('admin.error.passrequire'),
                'pass.min' => trans('admin.error.passmin'),
                'pass.max' => trans('admin.error.passmax'),
                'repass.required' => trans('admin.error.repassrequire'),
                'repass.same' => trans('admin.error.repasssame')
            ]);
        $user->password = bcrypt($request->pass);
        $user->save();
        return redirect()->back()->with('message', trans('admin.message.changepasssucess'));
    }
}
