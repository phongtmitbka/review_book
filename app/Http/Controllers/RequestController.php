<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookRequest;
use App\Http\Requests;

class RequestController extends Controller
{
    public function index()
    {
        $requests = BookRequest::paginate(Config('view.paginate'));
        return view('admin.request.request_list', ['requests' => $requests]);
    }

    public function show($id)
    {
        $request = BookRequest::find($id);
        return view('admin.request.request_del', ['request' => $request]);
    }

    public function destroy($id)
    {
        $request = BookRequest::find($id);
        $request->delete();
        return redirect('admin/request');
    }
}
