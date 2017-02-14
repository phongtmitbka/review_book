@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@lang('admin.label.comment')
                    <small>@lang('admin.label.list')</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>@lang('admin.label.id')</th>
                        <th>@lang('admin.label.userid')</th>
                        <th>@lang('admin.label.reviewid')</th>
                        <th>@lang('admin.label.reviewdate')</th>
                        <th>@lang('admin.label.content')</th>
                        <th>@lang('admin.label.del')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user_id }}</td>
                            <td>{{ $comment->review_id }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td>{{ $comment->comment }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ route('admin.comment.show', $comment->id) }}"> @lang('admin.label.del')</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    {{ $comments->links() }}
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
