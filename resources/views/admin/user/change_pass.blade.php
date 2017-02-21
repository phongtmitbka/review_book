@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@lang('admin.label.account')
                    <small>@lang('admin.label.change_pass')</small>
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
                <form action="{{ route('admin.changePass') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>@lang('admin.label.email')</label>
                        <input type="email" class="form-control" name="email" readonly="" value="{{ $user->email }}" />
                    </div>
                    <div class="form-group">
                        <label>@lang('admin.label.pass')</label>
                        <input type="password" class="form-control" name="pass" placeholder="@lang('admin.message.pass')" />
                    </div>
                    <div class="form-group">
                        <label>@lang('admin.label.repass')</label>
                        <input type="password" class="form-control" name="repass" placeholder="@lang('admin.message.repass')" />
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
