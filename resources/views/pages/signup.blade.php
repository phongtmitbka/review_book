@extends('layout.index')

@section('content')
<div class="container">        
    <div class="row carousel-holder">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                  <div class="panel-heading">
                      @lang('front.label.register')
                  </div>
                  @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}}<br>
                        @endforeach
                    </div>
                @endif
                @if(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                @endif
                  <div class="panel-body">
                    <form action="{{ route('user.store') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div>
                            <label>@lang('front.label.full_name')</label>
                              <input type="text" class="form-control" placeholder="@lang('front.message.name')" name="name" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div>
                            <label>@lang('front.label.email')</label>
                              <input type="email" class="form-control" placeholder="@lang('front.message.email')" name="email" aria-describedby="basic-addon1">
                        </div>
                        <br>    
                        <div>
                            <label>@lang('front.label.password')</label>
                              <input type="password" class="form-control" placeholder="@lang('front.message.password')" name="pass" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div>
                            <label>@lang('front.label.re_password')</label>
                              <input type="password" class="form-control" placeholder="@lang('front.message.re_password')" name="repass" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <label>@lang('front.label.language')</label>
                        <label class="radio-inline">
                            <input name="language" value="0" type="radio" checked="">@lang('front.label.english')
                        </label>
                        <label class="radio-inline">
                            <input name="language" value="1" type="radio"> @lang('front.label.vietnamese')
                        </label>
                        <br>
                        <button type="submit" class="btn btn-primary">
                            @lang('front.button.signup')
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
