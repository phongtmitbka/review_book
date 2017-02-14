<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;
use App\Http\Requests;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(config('view.paginate'));
        return view('admin.book.book_list', ['books' => $books]);
    }

    public function create()
    {
        $cates = Category::all();
        return view('admin.book.book_add', ['cates' => $cates]);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|min:3',
            ],
            [
                'title.required' => trans('admin.error.titlerequire'),
                'title.min' => trans('admin.error.titlemin'),
                'author.required' => trans('admin.error.authorrequire'),
                'author.min' => trans('admin.error.authormin')
            ]);
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publish_date = $request->date;
        $book->number_pages = $request->pages;
        $book->category_id = $request->cate;
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = str_random(5)."_".$name;
            $book->image = $name;
            $file->move('image', $name);
        }
        else $book->image = "";
        $book->save();
        return redirect()->back()->with('message', trans('admin.message.addsuccess'));
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
        $this->validate($request,
            [
                'title' => 'required|min:3',
            ],
            [
                'title.required' => trans('admin.error.titlerequire'),
                'title.min' => trans('admin.error.titlemin'),
                'author.required' => trans('admin.error.authorrequire'),
                'author.min' => trans('admin.error.authormin')
            ]) ;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publish_date = $request->date;
        $book->category_id = $request->cate;
        $book->number_pages = $request->pages;
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = str_random(5)."_".$name;
            $book->image = $name;
            $file->move('image', $name);
        }
        $book->save();
        return redirect()->back()->with('message', trans('admin.message.editsuccess'));
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
}
