<h3>@lang('front.label.popular_book')</h3>
@foreach ($book_tops as $book_top)
    <a href="{{ route('bookDetail', $book_top->id) }}" class="list-group-item">
        {{ $book_top->title }}
    </a>
@endforeach
