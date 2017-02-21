@extends('layout.index')

@section('content')
<div class="container">
    <div class="row carousel-holder">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('front.label.login')
                </div>
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
                    <form action="{{ route('user.checkLogin') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div>
                            <label>@lang('front.label.email')</label>
                              <input type="email" class="form-control" placeholder="@lang('front.message.email')" name="email" required="">
                        </div>
                        <br>    
                        <div>
                            <label>@lang('front.label.password')</label>
                              <input type="password" class="form-control" placeholder="@lang('front.message.password')" name="pass" required="">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-default">
                            @lang('front.button.login')
                        </button>
                    </form>
                  </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>        
</div>
@endsection
