<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(Config('view.paginate'));
        $result = User::all()->count();

        return view('admin.user.user_list', ['users' => $users, 'result' => $result]);
    }

    public function create()
    {
        return view('admin.user.user_add');
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

        return redirect()->back()->with('message', trans('admin.message.add_success'));
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.user_edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validator = Validator::make($request->only('name'), $user->rules('update'), $user->messages());
        
        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user->store($request);

        return redirect()->back()->with('message', trans('admin.message.edit_success'));
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('admin/user');
    }

    public function show($id)
    {
        $user = User::find($id);
        
        return view('admin.user.user_del', ['user' => $user]);
    }

    public function searchUser(Request $request)
    {
        $value = $request->search;
        $users = User::where('name', 'like', $value."%")->paginate(config('view.paginate'));
        $result = User::where('name', 'like', $value."%")->count();

        return view('admin.user.user_list', ['users' => $users, 'value' => $value, 'result' => $result]);
    }
}
