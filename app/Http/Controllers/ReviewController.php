<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Http\Requests;

class ReviewController extends Controller
{
    public function index()
    {
    	$reviews = Review::paginate(Config('view.paginate'));
        return view('admin.review.review_list',['reviews'=>$reviews]);
    }

    public function show($id)
    {
    	$review = Review::find($id);
    	return view('admin.review.review_del', ['review' => $review]);
    }

    public function destroy($id)
    {
    	$review = Review::find($id);
    	$review->delete();
    	return redirect('admin/review');
    }
}
