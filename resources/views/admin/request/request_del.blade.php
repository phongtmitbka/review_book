@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@lang('admin.label.request')
                    <small>@lang('admin.label.del')</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7">
                <form action="{{ route('admin.request.destroy', $request->id) }}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div>
                        <label>@lang('admin.label.del')</label>
                        <input class="form-control" value="{{ $request->title }}" readonly="" />
                    </div>
                    </br>
                    <button type="submit" class="btn btn-primary">@lang('admin.button.del')</button>
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
