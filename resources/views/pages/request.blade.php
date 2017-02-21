@extends('layout.index')

@section('content')
<div class="container">        
    <div class="row carousel-holder">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                  <div class="panel-heading">@lang('front.label.request_book')</div>
                  <div class="panel-body">
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
                    <form action="{{ route('user.request') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div>
                            <label>@lang('front.label.email')</label>
                              <input type="text" class="form-control" value="{{ $user_login->email }}" aria-describedby="basic-addon1" disabled>
                        </div>
                        <br>
                        <div>
                            <label>@lang('front.label.name')</label>
                              <input type="text" class="form-control" value="{{ $user_login->name }}" aria-describedby="basic-addon1" disabled>
                        </div>
                        <br>
                        <div>
                            <label>@lang('front.label.title')</label>
                              <input type="text" class="form-control" name="title" aria-describedby="basic-addon1" placeholder="@lang('front.message.title')">
                        </div>
                        <br>
                        <div>
                            <label>@lang('front.label.category')</label>
                            <select name="cate" class="btn btn-default">
                                @foreach ($cates as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                            <label>@lang('front.label.image')</label>
                              <input type="file" class="btn btn-default" name="image">
                              </br>
                        <button type="submit" class="btn btn-primary">
                            @lang('front.button.send')
                        </button>
                        <button type="reset" class="btn btn-default">
                            @lang('front.button.reset')
                        </button>
                    </form>
                  </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>        
</div>
@endsection
