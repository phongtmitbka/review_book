<div class="col-md-3">
    <ul class="list-group">
        <h3>@lang('front.label.my_profile')</h3>
        <li class="list-group-item">
            @lang('front.label.name'): {{ $user_login->name }}
        </li>
        <li class="list-group-item">
            @lang('front.label.email'): {{ $user_login->email }}
        </li>
        <li class="list-group-item">
            @lang('front.label.number_review'): {{ $user_login->reviews->count() }}
        </li>
    </ul>
    <div class="list-group">
        <h3>@lang('front.label.my_review')</h3>
        @foreach ($user_login->reviews as $review)
            <a href="{{ route('reviewDetail', $review->id) }}" class="list-group-item">
                {{ $review->book->title }}
            </a>
        @endforeach
        <h3>@lang('front.label.my_favorite')</h3>
        @foreach ($favorites as $favorite)
            <a href="{{ route('bookDetail', $favorite->book->id) }}" class="list-group-item">
                {{ $favorite->book->title }}
            </a>
        @endforeach
        <h3>@lang('front.label.reading')</h3>
        @foreach ($book_reads as $book_read)
            <a href="{{ route('bookDetail',$book_read->book->id) }}" class="list-group-item">
                {{ $book_read->book->title }}
            </a>
        @endforeach
        <h3>@lang('front.label.readed')</h3>
        @foreach ($book_readeds as $book_readed)
            <a href="{{ route('bookDetail', $book_readed->book->id) }}" class="list-group-item">
                {{ $book_readed->book->title }}
            </a>
        @endforeach
        <h3>@lang('front.label.my_request')</h3>
        @foreach ($user_login->book_requests as $book_request)
            <a href="{{ route('user.bookRequest', $book_request->id) }}" class="list-group-item">
                {{ $book_request->title }}
            </a>
        @endforeach
    </div>
</div>
