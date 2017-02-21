@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-header">@lang('admin.label.cate')
                    <small>@lang('admin.label.list')</small>
                </h1>
                <h2>
                    <small>@lang('admin.label.number_result'): {{ $result }}</small>
                </h2>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('admin.searchCategory') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="@lang('admin.message.cate_name')" value="{{ isset($value) ? $value : '' }}" required="">
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
                        <th>@lang('admin.label.cate_name')</th>
                        <th>@lang('admin.label.del')</th>
                        <th>@lang('admin.label.edit')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cates as $cate)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $cate->id }}</td>
                            <td>{{ $cate->name }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ route('admin.cate.show', $cate->id) }}"> @lang('admin.label.del')</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('admin.cate.edit', $cate->id) }}">@lang('admin.label.edit')</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    {{ isset($value) ? $cates->appends(['search' => $value])->links() : $cates->links() }}
</div>
<!-- /#page-wrapper -->
@endsection
