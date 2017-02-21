<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Http\Requests;

class ReviewController extends Controller
{
    public function index()
    {
        $result = Review::all()->count();
        $reviews = Review::orderBy('id', 'desc')->paginate(Config('view.paginate'));
        
        return view('admin.review.review_list',['reviews'=>$reviews, 'result' => $result]);
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

    public function searchReview(Request $request)
    {
        $value = $request->search;
        $result = Review::where('review', 'like', "%".$value."%")->count();
        $reviews = Review::where('review', 'like', "%".$value."%")->paginate(config('view.paginate'));
        
        return view('admin.review.review_list', ['reviews' => $reviews, 'value' => $value, 'result' => $result]);
    }
}
