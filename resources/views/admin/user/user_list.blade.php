@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="page-header"><th>@lang('admin.label.member')</th>
                    <small><th>@lang('admin.label.list')</th></small>
                </h1>
                <h2>
                    <small>@lang('admin.label.number_result'): {{ $result }}</small>
                </h2>
            </div>
            <div class="col-lg-4">
                <form action="{{ route('admin.searchUser') }}" method="GET">
                    <div class="input-group">
                        <input type="search" name="search" class="form-control" placeholder="@lang('admin.message.member_name')" value="{{ isset($value) ? $value : '' }}" required="">
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
                        <th>@lang('admin.label.email')</th>
                        <th>@lang('admin.label.member_name')</th>
                        <th>@lang('admin.label.level')</th>
                        <th>@lang('admin.label.edit')</th>
                        <th>@lang('admin.label.del')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td><a href="{{ route('member', $user->id) }}" target="_blank">{{ $user->name }}</a></td>
                            <td>{{ ($user->level == 1) ? 'Admin' : 'User'}}</td>
                            <td class="center"><i class="fa fa-pencil  fa-fw"></i><a href="{{ route('admin.user.edit', $user->id) }}"> @lang('admin.label.edit')</a></td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ route('admin.user.show', $user->id) }}"> @lang('admin.label.del')</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    {{ isset($value) ? $users->appends(['search' => $value])->links() : $users->links() }}
</div>
<!-- /#page-wrapper -->
@endsection
