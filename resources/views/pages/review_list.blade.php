@extends('layout.index')

@section('content')
<div class="container">
    <div class="row main-left">
        <!--Left menu -->
        <div class="col-md-3">
            <div class="list-group">
                @include('layout.review_tops')
                @include('layout.cate_review')
            </div>
        </div>
        <!--End left menu -->
        <!--Main content -->
        <div class="col-md-7 col-md-9">
            <div class="col-md-7">
            </div>
            <form action="{{ route('searchReview') }}" method="GET">
                <div class="input-group col-md-5">
                    <input type="search" class="form-control" name="search" placeholder="@lang('front.label.search_review_content')" value="{{ isset($value) ? $value : '' }}" required="">    
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
                    @lang('front.label.all_review')
                @endif
            </h2>
            <!-- Item -->
            @if (!isset($book_cates))
                @foreach ($reviews as $review)
                    @include('layout.review')
                @endforeach

                {{ isset($value) ? $reviews->appends(['search' => $value])->links() : $reviews->links() }}
            @else 
                @foreach ($book_cates as $book_cate)
                    @foreach ($book_cate->reviews as $review)
                        @include('layout.review')
                    @endforeach
                @endforeach
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
