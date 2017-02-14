<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests;

class CateController extends Controller
{
    public function index()
    {
        $cate = Category::paginate(config('view.paginate'));
        
    	return view('admin.category.cate_list', ['cates' => $cate]);
    }

    public function create()
    {
    	return view('admin.category.cate_add');
    }

    public function store(Request $request )
    {
        $this->validate($request,
            [
                'cate' => 'required|unique:categories,name'
            ],
            [
                'cate.required' => trans('admin.error.caterequire'),
                'cate.unique' => trans('admin.error.cateunique')
            ]) ;
        $cate = new Category;
        $cate->name = $request->cate;
        $cate->save();
        return redirect()->back()->with('message', trans('admin.message.addsuccess'));
    }

    public function edit($id)
    {
        $cate = Category::find($id);

        return view('admin.category.cate_edit', ['cate' => $cate]);
    }

    public function update(Request $request, $id)
    {       
        $cate = Category::find($id);
        $this->validate($request,
            [
                'cate' => 'required|unique:categories,name'
            ],
            [
                'cate.required' => trans('admin.error.caterequire'),
                'cate.unique' => trans('admin.error.catenotchange')
            ]);
        $cate->name = $request->cate;
        $cate->save();
        return redirect()->back()->with('message', trans('admin.message.editsuccess'));
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
}
