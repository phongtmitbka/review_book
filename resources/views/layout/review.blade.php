<div class="panel panel-default">
    <div class="panel-heading">
        <h5>@lang('front.label.title'): {{ $review->book->title }}</h5>
        <h4>@lang('front.label.reviewer'): 
            <a href="{{ route('member', $review->user->id) }}">{{ $review->user->name }}</a>
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
                <p>{!! str_limit($review->review, $limit = 200, $end = '...') !!}</p> 
                <p>
                    <span>{{ $review->number_like }}</span> Like
                </p>
                <a class="btn btn-default" href="{{ route('reviewDetail', $review->id) }}">
                    @lang('front.label.full_review')
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>                            
        </div>
    </div>
</div>
