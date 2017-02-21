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
            <form action="{{ route('searchMember') }}" method="GET">
                <div class="input-group col-md-4">
                    <input type="search" class="form-control" name="search" placeholder="@lang('front.label.search_member')" value="{{ isset($value) ? $value : '' }}">    
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>                            
            </form>
            <h2>@lang('front.label.number_result'): {{ $result }}</h2>
            <!-- Item -->
            @foreach ($members as $member)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>@lang('front.label.name'): <a href="{{ route('member', $member->id) }}">{{ $member->name }}</a></h4>
                        <h5>@lang('front.label.number_review'): {{ $member->reviews->count() }}</a></h5>
                    </div>
                </div>
            @endforeach
            <!-- End item -->
        </div>
        <!-- End main content -->
        <!-- Right-list -->
        @include('layout.member')
        <!-- End right-list -->
    </div>        
</div>
@endsection
