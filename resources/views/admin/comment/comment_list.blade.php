@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-header">@lang('admin.label.comment')
                    <small>@lang('admin.label.list')</small>
                </h1>
                <h2>
                    <small>@lang('admin.label.number_result'): {{ $result }}</small>
                </h2>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('admin.searchComment') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="@lang('admin.message.comment_content')" value="{{ isset($value) ? $value : '' }}" required="">
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
                        <th>@lang('admin.label.review')</th>
                        <th>@lang('admin.label.comment_date')</th>
                        <th>@lang('admin.label.content')</th>
                        <th>@lang('admin.label.del')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td><a href="{{ route('reviewDetail', $comment->review_id) }}" title="@lang('front.label.full_review')" target="_blank">{{ $comment->review->book->title }}</a></td>
                            <td>{{ $comment->created_at }}</td>
                            <td>{{ str_limit($comment->comment, $limit = 10, $end = '...') }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ route('admin.comment.show', $comment->id) }}"> @lang('admin.label.del')</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    {{ isset($value) ? $comments->appends(['search' => $value])->links() : $comments->links() }}
</div>
<!-- /#page-wrapper -->
@endsection
