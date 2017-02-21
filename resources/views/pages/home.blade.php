@extends('layout.index')

@section('content')
<div class="container">
    <div class="row main-left">
        <!--Left menu -->
        @include('layout.left_menu_home')
        <!--End left menu -->
        <!--Main content -->
        <div class="col-md-7 col-md-9">
            <h2>@lang('front.label.my_review')</h2>
            <!-- Item -->
            @foreach ($reviews as $review)
                @include('layout.review')
            @endforeach
            
            {{ $reviews->links() }}
            <!-- End item -->
        </div>
        <!-- End main content -->
        <!-- Right-list -->
        @include('layout.follow')
        <!-- End right-list -->
    </div>      
</div>
@endsection
