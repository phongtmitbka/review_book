@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@lang('admin.label.book')
                    <small>@lang('admin.label.list')</small>
                <!-- /input-group -->
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>@lang('admin.label.id')</th>
                        <th>@lang('admin.label.title')</th>
                        <th>@lang('admin.label.author')</th>
                        <th>@lang('admin.label.image')</th>
                        <th>@lang('admin.label.publishdate')</th>
                        <th>@lang('admin.label.cateid')</th>
                        <th>@lang('admin.label.numberpages')</th>
                        <th>@lang('admin.label.rate')</th>
                        <th>@lang('admin.label.edit')</th>
                        <th>@lang('admin.label.del')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->image }}</td>
                            <td>{{ $book->publish_date }}</td>
                            <td>{{ $book->category_id }}</td>
                            <td>{{ $book->number_pages }}</td>
                            <td>{{ $book->rate }}</td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('admin.book.edit', $book->id) }}">@lang('admin.label.edit')</a></td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ route('admin.book.show', $book->id) }}"> @lang('admin.label.del')</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    {{ $books->links() }}
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
