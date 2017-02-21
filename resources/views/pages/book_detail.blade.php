@extends('layout.index')

@section('content')
<div class="container">
    <div class="row main-left">
        <!--Left menu -->
        <div class="col-md-3">
            <div class="list-group">
                @include('layout.book_tops')
                @include('layout.cate_book')	    
            </div>
        </div>
        <!--End left menu -->
        <!--Main content -->
        <div class="col-md-7 col-md-9">
            <form action="" method="post">
                <div class="col-md-8">						
                </div>	
                <div class="input-group col-md-4">
                    <input type="search" class="form-control" name="searchReview" placeholder="@lang('front.label.search_review')">	
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>							
            </form>
            <h2>{{ $book->title }}</h2>
            <!-- Item -->
                @if (!isset($user_login))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>@lang('front.label.title'): {{ $book->title }}</h5>
                            <h4>@lang('front.label.author'): 
                                <a href="{{ route('bookAuthor', $book->author) }}">{{ $book->author }}</a>
                            </h4>	
                        </div>
                        <div class="panel-body">
                            <div class="col-md-5">
                                <a href="{{ route('bookDetail', $book->id) }}">
                                    <img src="image/{{ $book->image }}" width="200" height="270" alt="{{ $book->title }}">
                                </a>
                            </div>
                            <div>
                                <h3>@lang('front.label.category'): {{ $book->category->name }}</h3>
                                <h4>@lang('front.label.publish_date'): {{ $book->publish_date }}</h4>
                                <h5>@lang('front.label.number_pages'): {{ $book->number_pages }}</h5>
                                <p>
                                    <a href="{{ route('reviewBook', $book->id) }}">
                                    @lang('front.label.number_review'): {{ $book->reviews->count() }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                @elseif(isset($user_book))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>
                                @lang('front.label.title'): {{ $user_book->book->title }}
                            </h5>
                            <h4>@lang('front.label.author'): 
                                <a href="{{ route('bookAuthor', $book->author) }}">{{ $user_book->book->author }}</a>
                            </h4>  
                        </div>
                        <div class="panel-body">
                            <h3>
                                @lang('front.label.rate'): {{ $user_book->book->rate }} *
                            </h3>
                            <p>
                                <form action="{{ route('user.voteAgain', $user_book->id) }}" method="POST" name="vote">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <select name="rate" class="btn btn-default">
                                        <option value="5" 
                                            @if ($user_book->rate == 5)
                                                selected
                                            @endif
                                            >5 *
                                        </option>
                                        <option value="4" 
                                            @if ($user_book->rate == 4)
                                                selected
                                            @endif
                                            >4 *
                                        </option>
                                        <option value="3" 
                                            @if ($user_book->rate == 3)
                                                selected
                                            @endif
                                            >3 *
                                        </option>
                                        <option value="2" 
                                            @if ($user_book->rate == 2)
                                                selected
                                            @endif
                                            >2 *
                                        </option>
                                        <option value="1" 
                                            @if ($user_book->rate == 1)
                                                selected
                                            @endif
                                            >1 *
                                        </option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">
                                        @if($user_book->rate > 0)
                                            @lang('front.label.vote_again')
                                        @else
                                            @lang('front.label.vote')
                                        @endif
                                    </button>
                                </form>
                            </p>
                            <div>
                                <div class="col-md-5">
                                    <a href="{{ route('bookDetail', $user_book->book->id) }}">
                                        <img src="image/{{ $user_book->book->image }}" width="200" height="270" alt="{{ $user_book->book->title }}">
                                    </a>
                                </div>
                                <div>
                                    <h3>@lang('front.label.category'): {{ $user_book->book->category->name }}</h3>
                                    <h4>@lang('front.label.publish_date'): {{ $user_book->book->publish_date }}</h4>
                                    <h5>@lang('front.label.number_pages'): {{ $user_book->book->number_pages }}</h5>
                                    <p>
                                        <a href="{{ route('reviewBook', $user_book->book->id) }}" title="@lang('front.label.readall')">
                                            @lang('front.label.number_review'): {{ $user_book->book->reviews->count() }}
                                        </a>
                                    </p>
                                    @if($user_book->favorite == 0)
                                        <a class="btn btn-primary" href="{{ route('user.favorite', $user_book->id) }}">
                                            @lang('front.label.favorite')
                                        </a>
                                    @else
                                        <a class="btn btn-default" href="{{ route('user.cancelFavorite', $user_book->id) }}">
                                            @lang('front.label.cancel_favorite')
                                        </a>
                                    @endif
                                    <a class="btn btn-default" href="{{ route('user.review', $user_book->book->id) }}">
                                    @lang('front.label.write_review')<span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                                </div>
                                <p>
                                    <form action="{{ route('user.status', $user_book->id) }}" method="post">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <select name="status" class="btn btn-default">
                                            <option value="1" 
                                                @if ($user_book->read_book_status == 1)
                                                    selected
                                                @endif
                                            >@lang('front.label.unread')
                                                >@lang('front.label.unread')
                                            </option>
                                            <option value="2"
                                                @if ($user_book->read_book_status == 2)
                                                    selected
                                                @endif
                                                >@lang('front.label.reading')
                                            </option>
                                            <option value="3"
                                                @if ($user_book->read_book_status == 3)
                                                    selected
                                                @endif
                                                >@lang('front.label.readed')
                                            </option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">
                                            @if ($book->user_book->read_book_status > 0)
                                                @lang('front.button.save_again')
                                            @else
                                                @lang('front.button.save')
                                            @endif
                                        </button>   
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>@lang('front.label.title'): {{ $book->title }}</h5>
                            <h4>@lang('front.label.author'): 
                                <a href="{{ route('bookAuthor', $book->id) }}" >{{ $book->author }}</a>
                            </h4>  
                        </div>
                        <div class="panel-body">
                            <h3>
                                @lang('front.label.rate'): {{ $book->rate }} *
                            </h3>
                            <div>
                                <div class="col-md-5">
                                    <a href="{{ route('bookDetail', $book->id) }}">
                                        <img src="image/{{ $book->image }}" width="200" height="270" alt="{{ $book->title }}">
                                    </a>
                                    </div>
                                    <div>
                                    <h3>@lang('front.label.category'): {{ $book->category->name }}</h3>
                                        <h4>@lang('front.label.publish_date'): {{ $book->publish_date }}</h4>
                                    <h5>@lang('front.label.number_pages'): {{ $book->number_pages }}</h5>
                                    <p>
                                        <a href="{{ route('reviewBook', $book->id) }}">
                                            @lang('front.label.number_review'): {{ $book->reviews->count() }}
                                        </a>
                                    </p> 
                                    <a href="{{ route('user.newFavorite', $book->id) }}" class="btn btn-primary" name="favorite">
                                        @lang('front.label.favorite')
                                    </a>
                                    <a class="btn btn-default" href="{{ route('user.review', $book->id) }}">
                                    @lang('front.label.write_review')<span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                                </div>
                                <p>
                                    <form action="{{ route('user.newUserBook', $book->id) }}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           	        <span>@lang('front.label.vote')</span>
                                        <select name="rate" class="btn btn-default">
                                        <option value="5">5*</option>
                                            <option value="4">4*</option>
                                            <option value="3">3*</option>
                                            <option value="2">2*</option>
                                            <option value="1">1*</option>
                                        </select>
                                        <select name="status" class="btn btn-default">
                                            <option value="1">@lang('front.label.unread')</option>
                                            <option value="2">@lang('front.label.reading')</option>
                                            <option value="3">@lang('front.label.readed')</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">
                                            @lang('front.button.save')
                                        </button>	
                                    </form>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            <!-- End item -->
        </div>
        <!-- End main content -->
        <!-- Right-list -->
        @include('layout.member')
        <!-- End right-list -->
    </div>
</div>
@endsection
