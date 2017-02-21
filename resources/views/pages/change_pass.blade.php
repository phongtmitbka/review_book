@extends('layout.index')

@section('content')
<div class="container">
    <div class="row carousel-holder">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('front.label.change_password')
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
                    <form action="{{ route('user.changePass') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>@lang('front.label.email')</label>
                            <input type="email" class="form-control" name="email" readonly="" value="{{ $user->email }}" />
                        </div>
                        <div class="form-group">
                            <label>@lang('front.label.password')</label>
                            <input type="password" class="form-control" name="pass" placeholder="@lang('front.message.password')" />
                        </div>
                        <div class="form-group">
                            <label>@lang('front.label.re_password')</label>
                            <input type="password" class="form-control" name="repass" placeholder="@lang('front.message.re_password')" />
                        </div>
                        <button type="submit" class="btn btn-primary">
                            @lang('front.button.save')
                        </button>
                        <button type="reset" class="btn btn-default">
                            @lang('front.button.reset')
                        </button>
                    <form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection
