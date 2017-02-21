<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookRequest;
use App\Http\Requests;

class RequestController extends Controller
{
    public function index()
    {
        $requests = BookRequest::orderBy('id', 'desc')->where('status', '<>', 0)->paginate(Config('view.paginate'));
        $result = BookRequest::where('status', '<>', 0)->count();
        
        return view('admin.request.request_list', ['requests' => $requests, 'result' => $result]);
    }

    public function newRequest()
    {
        $requests = BookRequest::where('status', 0)->paginate(Config('view.paginate'));
        $result = BookRequest::where('status', 0)->count();
        
        return view('admin.request.new_request', ['requests' => $requests, 'result' => $result]);
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

    public function update(Request $request, $id)
    {
        $book_request = BookRequest::find($id);
        $book_request->statusRequest($request);

        return redirect()->back();
    }

    public function searchRequest(Request $request)
    {
        $value = $request->search;
        $book_requests = BookRequest::where('status', '<>', 0)->where('title', 'like', $value."%")->paginate(config('view.paginate'));
        $result = BookRequest::where('status', '<>', 0)->where('title', 'like', $value."%")->count();
        
        return view('admin.request.request_list', ['requests' => $book_requests, 'value' => $value, 'result' => $result]);
    }

    public function searchNewRequest(Request $request)
    {
        $value = $request->search;
        $book_requests = BookRequest::where('status', 0)->where('title', 'like', $value."%")->paginate(config('view.paginate'));
        $result = BookRequest::where('status', 0)->where('title', 'like', $value."%")->count();
        
        return view('admin.request.new_request', ['requests' => $book_requests, 'value' => $value, 'result' => $result]);
    }

    public function accept($id)
    {
        $request = BookRequest::find($id);
        $request->saveStatus(1);
        return redirect('admin/request');
    }

    public function reject($id)
    {
        $request = BookRequest::find($id);
        $request->saveStatus(2);
        return redirect('admin/request');
    }
}
