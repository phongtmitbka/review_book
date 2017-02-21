@extends('layout.index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
        <div class="panel-heading">
            <h5>@lang('front.label.title'): {{ $book->title }}</h5>
            <h4>@lang('front.label.author'): <a href="bookAuthor/{{ $book->author }}" >{{ $book->author }}</a></h4>    
        </div>
        <div class="panel-body">
            <div>
                <div class="col-md-5">
                    <a href="{{ route('bookDetail', $book->id) }}">
                        <img src="image/{{ $book->image }}" width="200" height="270" alt="">
                    </a>
                </div>
                <div>
                    <h3>@lang('front.label.category'): {{ $book->category->name }}</h3>
                    <h4>@lang('front.label.publish_date'): {{ $book->publish_date }}</h4>            
                </div>
            </div>
        </div>
    </div>
        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <p>
                <form action="{{ route('user.review', $book->id) }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>@lang('front.label.name')</label>
                        <input class="form-control" name="name" value ="{{ $user_login->name }}" readonly="" />
                    </div>
                    <div class="form-group">
                        <label>@lang('front.label.email')</label>
                        <input class="form-control" name="email" value="{{ $user_login->email }}" readonly="" />
                    </div>
                    <div class="form-group">
                        <label>@lang('front.label.write_review')</label>
                        <textarea class="form-control ckeditor" rows="10" name="review"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">
                        @lang('front.button.send')
                    </button>
                    <button type="reset" class="btn btn-default">
                        @lang('front.button.reset')
                    </button>
                <form>
            </p>
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection
