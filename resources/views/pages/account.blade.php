@extends('layout.index')

@section('content')
<div class="container">
    <div class="row carousel-holder">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('front.label.my_account')
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
                <form action="{{ route('user.update', $user_login->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>@lang('front.label.email')</label>
                        <input type="email" class="form-control" name="email" readonly="" value="{{ $user->email }}" />
                    </div>
                    <div class="form-group">
                        <label>@lang('front.label.member_name')</label>
                        <input class="form-control" name="name" value="{{ $user->name }}" />
                    </div>
                    <div class="form-group">
                        <label>@lang('front.label.language')</label>
                        <label class="radio-inline">
                            <input name="language" 
                                @if ($user->language == 0) 
                                    checked = "checked"
                                @endif
                                value="0" type="radio">@lang('front.label.english')
                        </label>
                        <label class="radio-inline">
                            <input name="language" 
                                @if ($user->language == 1) 
                                    checked = "checked"
                                @endif
                                value="1" type="radio">@lang('front.label.vietnamese')
                        </label>
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
        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection
