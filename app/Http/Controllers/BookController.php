<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;
use App\Http\Requests;
use Validator;

class BookController extends Controller
{
    public function index()
    {
        $result = Book::all()->count();
        $books = Book::orderBy('id', 'desc')->paginate(config('view.paginate'));

        return view('admin.book.book_list', ['books' => $books, 'result' => $result]);
    }

    public function create()
    {
        $cates = Category::all();

        return view('admin.book.book_add', ['cates' => $cates]);
    }

    public function store(Request $request)
    {
        $book = new Book();     
        $validator = Validator::make($request->only('title', 'author'), $book->rules(), $book->messages());
        
        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $book->storeBook($request);

            return redirect()->back()->with('message', trans('admin.message.add_success'));
        }
    }

    public function edit($id)
    {
        $cates = Category::all();
        $book = Book::find($id);

        return view('admin.book.book_edit', ['book' => $book, 'cates' => $cates]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $validator = Validator::make($request->only('title', 'author','image'), $book->rules(), $book->messages());
        
        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $book->updateBook($request);

            return redirect()->back()->with('message', trans('admin.message.edit_success'));
        }
    }

    public function show($id)
    {
        $book = Book::find($id);

        return view('admin.book.book_del', ['book' => $book]);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        
        return redirect('admin/book');
    }

    public function searchBook(Request $request)
    {
        $value = $request->search;
        $books = Book::where('title', 'like', $value."%")->paginate(config('view.paginate'));
        $result = Book::where('title', 'like', $value."%")->count();

        return view('admin.book.book_list', ['books' => $books, 'value' => $value, 'result' => $result]);
    }
}
