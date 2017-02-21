<h3>@lang('front.label.popular_review')</h3>
@foreach ($review_tops as $review_top)
    <a href="{{ route('reviewDetail', $review_top->id) }}" class="list-group-item">
        {{ $review_top->book->title }}
    </a>
@endforeach
