<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use Validator;

class AccountUserController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function create()
    {
        return view('pages.signup');
    }

    public function store(Request $request)
    {
        $user = new User();
        $validator = Validator::make($request->all(), $user->rules('store'), $user->messages());
        
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user->store($request);

            return redirect()->back()->with('message', trans('front.message.signup_success'));
        }
    }

    public function checkLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email,'password' => $request->pass]))
        {
            return redirect('listReview');
        } else {
            return redirect()->back()->with('message', trans('front.error.login_fail'));
        }
    }

    public function edit()
    {
        $user = Auth::user();

        return view('pages.account', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->only('name'), $user->rules('update'), $user->messages());
        
        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user->store($request);

        return redirect()->back()->with('message', trans('front.message.edit_success'));
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('listReview');
    }

    public function showChangePass()
    {
        $user = Auth::user();

        return view('pages.change_pass', ['user' => $user]);
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

        return redirect()->back()->with('message', trans('front.message.change_pass_sucess'));
        }
    }
}
