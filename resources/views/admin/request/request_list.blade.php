@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@lang('admin.label.request')
                    <small>@lang('admin.label.list')</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>@lang('admin.label.id')</th>
                        <th>@lang('admin.label.userid')</th>
                        <th>@lang('admin.label.title')</th>
                        <th>@lang('admin.label.cateid')</th>
                        <th>@lang('admin.label.image')</th>
                        <th>@lang('admin.label.del')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requests as $request)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->user_id }}</td>
                            <td>{{ $request->title }}</td>
                            <td>{{ $request->category_id }}</td>
                            <td>{{ $request->image }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ route('admin.request.show', $request->id) }}"> @lang('admin.label.del')</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    {{ $requests->links() }}
    <form action="" method="get">
        <div class="input-group col-lg-4">
            <input type="search" name="search" class="form-control" placeholder="@lang('admin.message.search')">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
</div>
<!-- /#page-wrapper -->
@endsection
