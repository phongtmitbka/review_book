<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate(Config('view.paginate'));
        return view('admin.user.user_list', ['users' => $user]);
    }

    public function create()
    {
        return view('admin.user.user_add');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'pass' => 'required|min:6|max:32',
                'repass' => 'required|same:pass',
            ],
            [
                'email.required' => trans('admin.error.emailrequire'),
                'email.email' => trans('admin.error.email'),
                'email.unique' => trans('admin.error.emailunique'),
                'name.required' => trans('admin.error.namerequire'),
                'name.min' => trans('admin.error.namemin'),
                'pass.required' => trans('admin.error.passrequire'),
                'pass.min' => trans('admin.error.passmin'),
                'pass.max' => trans('admin.error.passmax'),
                'repass.required' => trans('admin.error.repassrequire'),
                'repass.same' => trans('admin.error.repasssame')
            ]);
        $user = new User;
        $user->name = $request->name;
        $user->password = bcrypt($request->pass);
        $user->email = $request->email;
        $user->level = $request->level;
        $user->language = $request->language;
        $user->save();
        return redirect()->back()->with('message', trans('admin.message.addsuccess'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.user_edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'name' => 'required|min:3',
            ],
            [
                'name.required' => trans('admin.error.namerequire'),
                'name.min' => trans('admin.error.namemin'),               
            ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->level = $request->level;
        $user->language = $request->language;
        $user->save();
        return redirect()->back()->with('message',trans('admin.message.editsuccess'));
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
}
