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
            <div class="col-md-7">
                @if (isset($user_login))
                    <a href="{{ route('user.request') }}" title="@lang('front.label.book_request')" class="btn btn-default">
                        @lang('front.label.request_book')
                    </a>
                @endif
            </div>
            <form action="{{ route('searchBook') }}" method="GET">
                <div class="input-group col-md-5">
                    <input type="search" class="form-control" name="search" placeholder="@lang('front.label.search_book_title')" value="{{ isset($value) ? $value : '' }}" required="">	
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <h2>
                @if (isset($result))
                    @lang('front.label.number_result'): {{ $result }}
                @else
                    @lang('front.label.all_book')
                @endif
            </h2>
            <!-- Item -->
            @foreach ($books as $book)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>@lang('front.label.title'): {{ $book->title }}</h5>
                        <h4>@lang('front.label.author'): 
                            <a href="{{ route('bookAuthor', $book->author) }}" >{{ $book->author }}</a>
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
                                <a href="{{ route('reviewBook', $book->id) }}" title="">
                                    @lang('front.label.number_review'): {{ $book->reviews->count() }}
                                </a>
                            </p>
                            @if(isset($user_login))
                                <a class="btn btn-default" href="{{ route('user.review', $book->id) }}">
                                    @lang('front.label.write_review')<span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- End item -->
            {{ isset($value) ? $books->appends(['search' => $value])->links() : $books->links() }}

        </div>
        <!-- End main content -->
        <!-- Right-list -->
        @include('layout.member')
        <!-- End right-list -->
    </div>
</div>
@endsection
