@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@lang('admin.label.cate')
                    <small>{{ $cate->name }}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7">
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
                <form action="{{ route('admin.cate.update', $cate->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div>
                        <label>@lang('admin.label.edit')</label>
                        <input class="form-control" name="cate" placeholder="@lang('admin.message.cate_name')" value="{{ $cate->name }}" />
                    </div>
                    </br>
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
