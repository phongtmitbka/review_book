@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@lang('admin.label.book')
                    <small>@lang('admin.label.add')</small>
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
                <form action="{{ route('admin.book.store') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>@lang('admin.label.book_name')</label>
                        <input class="form-control" name="title" placeholder="@lang('admin.message.book_name')" />
                    </div>
                    <div class="form-group">
                        <label>@lang('admin.label.author')</label>
                        <input class="form-control" name="author" placeholder="@lang('admin.message.author_name')" />
                    </div>
                    <div class="form-group">
                        <label>@lang('admin.label.publish_date')</label>
                        <input type="date" class="form-control" name="date" placeholder="@lang('admin.message.publish_date')" />
                    </div>
                    <div class="form-group">
                        <label>@lang('admin.label.select_cate')</label>
                        <select name="cate">
                            @foreach ($cates as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('admin.label.number_pages')</label>
                        <input type="number" class="form-control" name="pages" placeholder="@lang('admin.message.number_pages')" min="1" />
                    </div>
                    <div class="form-group">
                        <label>@lang('admin.label.image')</label>
                        <input type="file" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('admin.button.add')</button>
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
