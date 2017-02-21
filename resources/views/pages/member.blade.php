    @extends('layout.index')

    @section('content')
    <div class="container">
        <div class="row main-left">
            <!--Left menu -->
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item">{{ $user->name }}</li>
                    <li class="list-group-item">@lang('front.label.email'): {{ $user->email }}</li>
                    <li class="list-group-item">@lang('front.label.number_review'): {{ $user->reviews->count() }}</li>
                </ul>
                <div class="list-group">
                    <h3>@lang('front.label.review')</h3>
                    @foreach ($user->reviews as $review)
                        <a href="{{ route('reviewDetail', $review->id) }}" class="list-group-item">{{ $review->book->title }}</a>
                    @endforeach
                    <h3>@lang('front.label.favorite')</h3>
                    @foreach ($favorites as $favorite)
                        <a href="{{ route('bookDetail', $favorite->book->id) }}" class="list-group-item">{{ $favorite->book->title }}</a>
                    @endforeach</a>
                </div>
            </div>
            <!--End left menu -->
            <!--Main content -->
            <div class="col-md-9">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    @if(isset($user_login) && ($user->id != $user_login->id))
                        @if(isset($other_follow))
                            <a href="{{ route('user.unFollow', $other_follow->id) }}" class="btn btn-default" title="@lang('front.label.follow') {{ $user->name }}">
                                >> @lang('front.label.unfollow')
                            </a>
                        @else
                            <a href="{{ route('user.follow', $user->id) }}" class="btn btn-default" title="@lang('front.label.unfollow') {{ $user->name }}">
                                >> @lang('front.label.follow')
                            </a>
                        @endif
                    @endif
                </div>
                <br>
                <h2>@lang('front.label.review_of') {{ $user->name }}</h2>
                <!-- Item -->
                @foreach ($user->reviews as $review)
                    @include('layout.review')
                @endforeach
                <!-- End item -->
            </div>
            <!-- End main content -->
        </div>        
    </div>
    @endsection
