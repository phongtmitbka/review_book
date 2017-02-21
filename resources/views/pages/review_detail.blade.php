@extends('layout.index')

@section('content')
<div class="container">     
    <div class="col-lg-9">
        <h1>@lang('front.label.title'): {{ $review->book->title }}</h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>@lang('front.label.title'): {{ $review->book->title }}</h5>
                <h4>@lang('front.label.reviewer'): 
                    <a href="{{ route('member', $review->user->id) }}" >{{ $review->user->name }}</a>
                </h4>
                <h5>@lang('front.label.review_date'): {{ $review->created_at }}</h5> 
            </div>
            <div class="panel-body">
                <h3>
                    @lang('front.label.rate'): {{ $review->book->rate }} *
                </h3>
                <div>
                    <div class="col-md-5">
                        <a href="{{ route('bookDetail', $review->book->id) }}">
                            <img src="image/{{ $review->book->image }}" width="200" height="270" alt="{{ $review->book->title }}">
                        </a>
                    </div>
                    <div>
                        <h3>@lang('front.label.category'): {{ $review->book->category->name }}</h3>
                        <h4>@lang('front.label.publish_date'): {{ $review->book->publish_date }}</h4>
                        <h4>@lang('front.label.author'): 
                            <a href="{{ route('bookAuthor', $review->book->author) }}">
                                {{ $review->book->author }}
                            </a>
                        </h4>
                    </div>                          
                </div>
            </div>
        </div>
        <p>
            <span class="glyphicon glyphicon-time"></span> {{ $review->created_at }}
        </p>
        <hr>
        <!-- Post Content -->
        <p class="lead">
            {!! $review->review !!}
        </p>
        <hr>
        <p>
            <span>{{ $review->number_like }} like</span>
            @if (isset($user_login))
                @if (!isset($like) || $like->like ==0)
                    <a href="{{ route('user.like', $review->id) }}" class="btn btn-primary">Like</a>
                @else
                    <a href="{{ route('user.unlike', $like->id) }}" class="btn btn-default">Unlike</a>
                @endif
            @endif
        </p>
        <!-- Blog Comments -->
        <!-- Comments Form -->
        @if (isset($user_login))
            <div class="well">
                <h4>@lang('front.label.comment') <span class="glyphicon glyphicon-pencil"></span></h4>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <form action="{{ route('user.comment', $review->id) }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        @lang('front.button.send')
                    </button>
                </form>
            </div>
        @endif
        <hr>
        <!-- Posted Comments -->
        <!-- Comment -->
        @foreach ($comments as $comment)
            <p>
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">
                            {{ $comment->user->name }}
                            <small>{{ $comment->created_at }}</small>
                        </h4>
                        {{ $comment->comment }}
                    </div>
                </div>
            </p>
        @endforeach
        <hr>
    </div>
    <div class="col-md-3">
        <div class="list-group">
            <h3>@lang('front.label.same_author')</h3>
            @foreach ($review->user->reviews as $review)
                <a href="{{ route('reviewDetail', $review->id) }}" class="list-group-item">{{ $review->book->title }}</a>
            @endforeach
            <h3>@lang('front.label.same_category')</h3>
            @foreach ($review->book->category->books as $book)
                @foreach ($book->reviews as $review)
                    <a href="{{ route('reviewDetail', $review->id) }}" class="list-group-item">{{ $review->book->title }}</a>
                @endforeach
            @endforeach
            <h3>@lang('front.label.popular_review')</h3>
            @foreach ($review_tops as $review_top)
                <a href="{{ route('reviewDetail', $review_top->id) }}" class="list-group-item">{{ $review_top->book->title }}</a>
            @endforeach
        </div>
    </div>    
</div>
@endsection
