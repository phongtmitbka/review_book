<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests;

class CommentController extends Controller
{
    public function index()
    {
    	$comments = Comment::paginate(Config('view.paginate'));
    	return view('admin.comment.comment_list', ['comments' => $comments]);
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
}

