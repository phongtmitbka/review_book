<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('id', 'desc')->paginate(Config('view.paginate'));
        $result = Comment::all()->count();

        return view('admin.comment.comment_list', ['comments' => $comments, 'result' => $result]);
    }

    public function show($id)
    {
        $comment = Comment::find($id);

        return view('admin.comment.comment_del', ['comment' => $comment]);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect('admin/comment');
    }

    public function searchComment(Request $request)
    {
        $value = $request->search;
        $comments = Comment::where('comment', 'like', "%".$value."%")->paginate(config('view.paginate'));
        $result = Comment::where('comment', 'like', "%".$value."%")->count();
        
        return view('admin.comment.comment_list', ['comments' => $comments, 'value' => $value, 'result' => $result]);
    }
}
