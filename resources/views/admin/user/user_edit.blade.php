@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@lang('admin.label.member')
                    <small>{{ $user->name }}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7">
                @if (count($errors)>0)
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
                <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>@lang('admin.label.email')</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly="" />
                    </div>
                    <div class="form-group">
                        <label>@lang('admin.label.member_name')</label>
                        <input class="form-control" name="name" value="{{ $user->name }}" />
                    </div>
                    <div class="form-group">
                        <label>@lang('admin.label.level')</label>
                        <label class="radio-inline">
                            <input name="level" 
                            @if ($user->level == 1) 
                                checked = "checked"
                            @endif
                            value="1" type="radio">@lang('admin.label.admin')
                        </label>
                        <label class="radio-inline">
                            <input name="level" 
                            @if ($user->level == 2) 
                                checked = "checked"
                            @endif
                            value="2" type="radio">@lang('admin.label.member')
                        </label>
                    </div>
                    <div class="form-group">
                        <label>@lang('admin.label.language')</label>
                        <label class="radio-inline">
                            <input name="language" 
                            @if ($user->language == 0) 
                                checked = "checked"
                            @endif
                            value="0" type="radio">@lang('admin.label.english')
                        </label>
                        <label class="radio-inline">
                            <input name="language" 
                            @if ($user->language == 1) 
                                checked = "checked"
                            @endif
                            value="1" type="radio">@lang('admin.label.vietnamese')
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('admin.button.save')</button>
                    <button type="reset" class="btn btn-default">@lang('admin.button.reset')</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
