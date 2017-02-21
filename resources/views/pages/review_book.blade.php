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
            <div class="col-md-8">
            </div>
            <form action="{{ route('searchReview') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-group col-md-4">
                    <input type="search" class="form-control" name="search" placeholder="@lang('front.label.search_review')">    
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>                            
            </form>            
            <h2>@lang('front.label.all_review')</h2>
            <!-- Item -->
            @foreach ($reviews as $review)
                @include('layout.review')
            @endforeach
            
            {{ $reviews->links() }}
            <!-- End item -->
        </div>
        <!-- End main content -->
        <!-- Right-list -->
        @include('layout.member')
        <!-- End right-list -->
    </div>        
</div>
@endsection
