<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\Category;
use App\User;
use App\UserBook;
use App\Review;
use App\BookRequest;
use App\Comment;
use App\FollowOther;
use App\Like;
use App;
use Validator;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->login();
        $top = config('view.top');
        $cates = Category::all();
        $users = User::all();
        $book_tops = Book::orderby('rate', 'desc')->take($top)->get();
        $review_tops = Review::orderby('number_like', 'desc')->take($top)->get();
        $reviews = Review::orderBy('id', 'desc')->paginate(config('view.paginate'));
        $books = Book::orderBy('id', 'desc')->paginate(config('view.paginate'));

        $user = Auth::user();
        if(isset($user))
        {
            $favorites = UserBook::where('favorite', '1')->where('user_id', $user->id)->get();
            $book_reads = UserBook::where('read_book_status', '2')->where('user_id', $user->id)->get();
            $book_readeds = UserBook::where('read_book_status', '3')->where('user_id', $user->id)->get();

            view()->share('favorites', $favorites);
            view()->share('book_reads', $book_reads);
            view()->share('book_readeds', $book_readeds);
        }

        view()->share('cates', $cates);
        view()->share('users', $users);
        view()->share('book_tops', $book_tops);
        view()->share('review_tops', $review_tops);
        view()->share('reviews', $reviews);
        view()->share('books', $books);

    }

    public function index()
    {
        $title = 'review_list';

        return view('pages.review_list', ['title' => $title]);
    }

    public function showBook()
    {
        $title = 'show_book';

        return view('pages.book_list', ['title' => $title]);
    }

    public function showBookCate($id)
    {
        $title = 'show_book_cate';
        $books = Book::where('category_id', $id)->paginate(config('view.paginate'));

        return view('pages.book_list', ['books' => $books, 'title' => $title]);
    }

    public function searchBook(Request $request)
    {
        $title = 'search_book';
        $value = $request->search;
        $result = Book::where('title', 'like', "%".$value."%")->count();
        $books = Book::where('title', 'like', $value."%")->paginate(config('view.paginate'));

        return view('pages.book_list', ['books' => $books, 'value' => $value, 'title' => $title, 'result' => $result]);
    }

    public function showBookAuthor($name)
    {
        $title = 'show_book_author';
        $books = Book::where('author', $name)->paginate(config('view.paginate'));

        return view('pages.book_list', ['books' => $books, 'title' => $title]);
    }

    public function showReviewList()
    {
        $title = 'review_list';
        return view('pages.review_list');
    }

    public function showReviewCate($id)
    {
        $title = 'show_review_cate';
        $book_cates = Category::find($id)->books()->get();

        return view('pages.review_list', ['book_cates' => $book_cates, 'title' => $title]);
    }

    public function showReviewBook($id)
    {
        $title = 'review';
        $reviews = Book::find($id)->reviews()->paginate(config('view.paginate'));

        return view('pages.review_book', ['reviews' => $reviews, 'title' => $title]);
    }

    public function searchReview(Request $request)
    {
        $title = 'search_review';
        $value = $request->search;
        $result = Review::where('review', 'like', "%".$value."%")->count();
        $reviews = Review::where('review', 'like', "%".$value."%")->paginate(config('view.paginate'));

        return view('pages.review_list', ['reviews' => $reviews, 'value' => $value, 'title' => $title, 'result' => $result]);
    }

    public function showReviewDetail($id)
    {
        $title = 'show_review_detail';
        $review = Review::find($id);
        $comments = Comment::where('review_id', $id)->orderby('id', 'desc')->get();
        $user = Auth::user();

        if(isset($user))
        {
            $like = Like::where('review_id', $id)->where('user_id', $user->id)->first();

            if(isset($like))

                return view('pages.review_detail', ['review' => $review, 'comments' => $comments, 'like' => $like, 'title' => $title]);

            return view('pages.review_detail', ['review' => $review, 'comments' => $comments, 'title' => $title]);
        }
        return view('pages.review_detail', ['review' => $review, 'comments' => $comments, 'title' => $title]);
    }

    public function showReview($id)
    {
        $title = 'show_review';
        $book = Book::find($id);

        return view('pages.review', ['book' => $book, 'title' => $title]);
    }

    public function storeReview(Request $request, $id)
    {
        $review = new Review();
        $validator = Validator::make($request->only('review'), $review->rules(), $review->messages());

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $review->store($request, $id);
        }
        return redirect()->back()->with('message', trans('front.message.send_review_success'));
    }

    public function storeComment(Request $request, $id)
    {
        $comment = new Comment();
        $validator = Validator::make($request->only('comment'), $comment->rules(), $comment->messages());

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $comment->store($request, $id);
        }

        return redirect()->back();
    }

    public function showHome()
    {
        $title = 'home';
        $reviews = Auth::user()->reviews()->paginate(config('view.paginate'));

        return view('pages.home', ['reviews' => $reviews, 'title' => $title]);
    }

    public function showMember($id)
    {
        $title = 'show_member';
        $user = User::find($id);
        $favorites = UserBook::where('favorite', '1')->where('user_id', $id)->get();

        if(!isset(Auth::user()->id))

            return view('pages.member', ['user' => $user, 'favorites' => $favorites]);

        $other_follow = FollowOther::where('user_followed_id', $id)->where('user_follow_id', Auth::user()->id)->first();

        return view('pages.member', ['user' => $user, 'favorites' => $favorites, 'other_follow' => $other_follow, 'title' => $title]);

    }

    public function searchMember(Request $request)
    {
        $title = 'search_member';
        $value = $request->search;
        $result = User::where('name', 'like', $value."%")->count();
        $members = User::where('name', 'like', $value."%")->get();

        return view('pages.search_member', ['members' => $members, 'value' => $value, 'title' => $title, 'result' => $result]);
    }


    public function follow($id)
    {
        $follow = new FollowOther();
        $follow->store($id);

        return redirect()->back();
    }

    public function unFollow($id)
    {
        $follow = FollowOther::find($id);
        $follow->delete();

        return redirect()->back();
    }

    public function showBookDetail($id)
    {
        $title = 'show_book_detail';
        $book = Book::find($id);
        $user = Auth::user();

        if(isset($user))
        {
            $user_book = UserBook::where('book_id', $id)->where('user_id', $user->id)->first();

            if(isset($user_book))

                return view('pages.book_detail', ['book' => $book, 'user_book' => $user_book, 'title' => $title]);

            return view('pages.book_detail', ['book' => $book, 'title' => $title]);
        }
        return view('pages.book_detail', ['book' => $book, 'title' => $title]);
    }

    public function createRequest()
    {
        return view('pages.request');
    }

    public function showBookRequest($id)
    {
        $title = 'show_book_request';
        $book_request = BookRequest::find($id);

        return view('pages.book_request', ['book_request' => $book_request, 'title' => $title]);
    }

    public function storeRequest(Request $request)
    {
        $book_request = new BookRequest();
        $validator = Validator::make($request->only('title'), $book_request->rules(), $book_request->messages());

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $book_request->store($request);

            return redirect()->back()->with('message', trans('front.message.send_success'));
        }
    }

    public function cancelRequest($id)
    {
        $book_request = BookRequest::find($id);
        $book_request->delete();

        return redirect('user/home');
    }

    public function vote(Request $request, $id)
    {
        $user_book = new UserBook();
        $user_book->storeVote($request, $id);
        $this->rate($id);

        return redirect()->back();
    }

    public function voteAgain(Request $request, $id)
    {
        $user_book = UserBook::find($id);
        $user_book->storeVote($request, $id);
        $this->rate($user_book->book->id);

        return redirect()->back();
    }

    public function rate($book_id)
    {
        $book = Book::find($book_id);
        $book->rate($book_id);
    }

    public function createFavorite($id)
    {
        $user_book = new UserBook();
        $user_book->createFavorite($id);

        return redirect()->back();
    }

    public function favorite($id)
    {
        $user_book = UserBook::find($id);
        $user_book->favorite($id);

        return redirect()->back();
    }

    public function cancelFavorite($id)
    {
        $user_book = UserBook::find($id);
        $user_book->cancelFavorite($id);

        return redirect()->back();
    }

    public function updateStatus(Request $request, $id)
    {
        $user_book = UserBook::find($id);
        $user_book->updateStatus($request);

        return redirect()->back();
    }

    public function createUserBook(Request $request, $book_id)
    {
        $user_book = new UserBook();
        $user_book->createUserBook($request, $book_id);
        $this->rate($book_id);

        return redirect()->back();
    }

    public function like($id)
    {
        $like = Like::where('review_id', $id)->where('user_id', Auth::user()->id)->first();

        if(!isset($like))
            {
                $like = new Like();
                $like->review_id = $id;
                $like->user_id = Auth::user()->id;
            }
        $like->store(1);
        $review = Review::find($id);
        $review->updateNumberLike('add');

        return redirect()->back();
    }

    public function unLike($id)
    {
        $like = Like::find($id);
        $like->store(0);
        $review = Review::find($like->review_id);
        $review->updateNumberLike('');

        return redirect()->back();
    }
}
