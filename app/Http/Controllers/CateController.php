<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests;
use Validator;

class CateController extends Controller
{
    public function index()
    {
        $result =Category::all()->count();
        $cates = Category::paginate(config('view.paginate'));
        
        return view('admin.category.cate_list', ['cates' => $cates, 'result' => $result]);
    }

    public function create()
    {
        return view('admin.category.cate_add');
    }

    public function store(Request $request )
    {
        $cate = new Category;
        $validator = Validator::make($request->all(), $cate->rules(), $cate->messages());
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $cate->store($request);
        
            return redirect()->back()->with('message', trans('admin.message.add_success'));
        }
    }

    public function edit($id)
    {
        $cate = Category::find($id);

        return view('admin.category.cate_edit', ['cate' => $cate]);
    }

    public function update(Request $request, $id)
    {       
        $cate = Category::find($id);
        $validator = Validator::make($request->all(), $cate->rules(), $cate->messages());
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $cate->store($request);

            return redirect()->back()->with('message', trans('admin.message.edit_success'));
        }
    }

    public function show($id)
    {
        $cate = Category::find($id);

        return view('admin.category.cate_del', ['cate' => $cate]);
    }

    public function destroy($id)
    {
        $cate = Category::find($id);
        $cate->delete();

        return redirect('admin/cate');
    }

    public function searchCategory(Request $request)
    {
        $value = $request->search;
        $cates = Category::where('name', 'like', $value."%")->paginate(config('view.paginate'));
        $result = Category::where('name', 'like', $value."%")->count();
        
        return view('admin.category.cate_list', ['cates' => $cates, 'value' => $value, 'result' => $result]);
    }
}
