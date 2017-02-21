@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-header"><th>@lang('admin.label.review')</th>
                    <small><th>@lang('admin.label.list')</th></small>
                </h1>
                <h2>
                    <small>@lang('admin.label.number_result'): {{ $result }}</small>
                </h2>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('admin.searchReview') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="@lang('admin.message.review_content')" value="{{ isset($value) ? $value : '' }}" required="">
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
                        <th>@lang('admin.label.book')</th>
                        <th>@lang('admin.label.review_date')</th>
                        <th>@lang('admin.label.content')</th>
                        <th>@lang('admin.label.number_like')</th>
                        <th>@lang('admin.label.del')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                        <tr class="odd gradeX" align="center">
                            <td>{{$review->id}}</td>
                            <td>{{$review->user->name}}</td>
                            <td>{{$review->book->title}}</td>
                            <td>{{$review->created_at}}</td>
                            <td>{!! str_limit($review->review, $limit = 200, $end = '...') !!}<a href="{{ route('reviewDetail', $review->id) }}" title="@lang('front.label.full_review')" target="_blank">@lang('front.label.full_review')</a></td>
                            <td>{{$review->number_like}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ route('admin.review.show', $review->id) }}"> @lang('admin.label.del')</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    {{ isset($value) ? $reviews->appends(['search' => $value])->links() : $reviews->links() }}
</div>
<!-- /#page-wrapper -->
@endsection
