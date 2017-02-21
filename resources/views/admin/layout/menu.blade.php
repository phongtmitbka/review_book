<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <h1></h1>
            <li>
                <a href="{{ route('admin.cate.index') }}"><i class="fa fa-dashboard fa-fw"></i> @lang('admin.title') </a>
            </li>
            <li>
                <a href="{{ route('admin.cate.index') }}"><i class="fa fa-bar-chart-o fa-fw"></i> @lang('admin.label.cate')<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin.cate.index') }}">@lang('admin.label.list')</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cate.create') }}">@lang('admin.label.add')</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href=""><i class="fa fa-book fa-fw"></i> @lang('admin.label.book')<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin.book.index') }}">@lang('admin.label.list')</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.book.create') }}">@lang('admin.label.add')</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a><i class="fa fa-users fa-fw"></i> @lang('admin.label.member')<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('admin.user.index') }}">@lang('admin.label.list')</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.create') }}">@lang('admin.label.add')</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.newRequest') }}">@lang('admin.label.new_request')</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.request.index') }}">@lang('admin.label.request')</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.review.index') }}">@lang('admin.label.review')</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.comment.index') }}">@lang('admin.label.comment')</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
