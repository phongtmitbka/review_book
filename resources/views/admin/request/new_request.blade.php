@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-header">@lang('admin.label.request')
                    <small>@lang('admin.label.new')</small>
                </h1>
                <h2>
                    <small>@lang('admin.label.number_result'): {{ $result }}</small>
                </h2>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('admin.searchNewRequest') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="@lang('admin.message.book_name')" value="{{ isset($value) ? $value : '' }}" required="">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>@lang('admin.label.id')</th>
                        <th>@lang('admin.label.user')</th>
                        <th>@lang('admin.label.title')</th>
                        <th>@lang('admin.label.cate')</th>
                        <th>@lang('admin.label.image')</th>
                        <th>@lang('admin.label.accept')</th>
                        <th>@lang('admin.label.reject')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->user->name }}</td>
                            <td>{{ $request->title }}</td>
                            <td>{{ $request->category->name }}</td>
                            <td><img src="image/{{ $request->image }}" width="80" height="100" alt="{{ $request->title }}"></td>
                            <td class="center"><a href="{{ route('admin.accept', $request->id) }}"> @lang('admin.label.accept')</a></td>
                            <td class="center"><a href="{{ route('admin.reject', $request->id) }}"> @lang('admin.label.reject')</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    {{ isset($value) ? $requests->appends(['search' => $value])->links() : $requests->links() }}
</div>
<!-- /#page-wrapper -->

@endsection
