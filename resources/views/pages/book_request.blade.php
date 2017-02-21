@extends('layout.index')

@section('content')
<div class="container">
    <div class="row main-left">
        <!--Left menu -->
        @include('layout.left_menu_home')
        <!--End left menu -->
        <!--Main content -->
        <div class="col-md-7 col-md-9">
            <h2>@lang('front.label.book_request')</h2>
            <!-- Item -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>@lang('front.label.title'): {{ $book_request->title }}</h5>
                    </div>
                    <div class="panel-body">
                        <div>
                            <div class="col-md-5">
                                <img src="image/{{ $book_request->image }}" width="200" height="270" alt="{{ $book_request->title }}">
                            </div>
                            <div>
                                <h3>@lang('front.label.category'): {{ $book_request->category->name }}</h3>
                                <h4>@lang('front.label.date_request'): {{ $book_request->created_at }}</h4>              
                            </div>
                            <div>
                                <h5>
                                    @lang('front.label.status'): 
                                    @if ($book_request->status ==  0)
                                        @lang('front.label.waiting')
                                    @elseif ($book_request->status == 1)
                                        @lang('front.label.accept')
                                    @else
                                        @lang('front.label.reject')
                                    @endif
                                </h5>
                            </div>
                            <a href="{{ route('user.cancelRequest', $book_request->id) }}" class="btn btn-default">
                                @lang('front.label.cancel_request')
                            </a>   
                        </div>
                    </div>
                </div>
            <!-- End item -->
        </div>
        <!-- End main content -->
        <!-- Right-list -->
        @include('layout.follow')
        <!-- End right-list -->
    </div>      
</div>
@endsection
