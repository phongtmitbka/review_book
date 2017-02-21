<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use Validator;

class AccountController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('admin/cate');
        } else {
            return redirect('admin')->with('message', trans('admin.error.login_fail'));
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.user_edit', ['user' => $user]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('admin');
    }

    public function showChangePass()
    {
        $user = Auth::user();

        return view('admin.user.change_pass', ['user' => $user]);
    } 

    public function storeChangePass(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->only('pass', 'repass'), $user->rules('changePass'), $user->messages());
        
        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user->store($request);

            return redirect()->back()->with('message', trans('admin.message.change_pass_sucess'));
        }
    }
}
