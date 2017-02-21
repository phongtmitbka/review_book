<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                @if (isset($user_login))
                    <li>
                        <a><i></i> {{ $user_login->name }}</a>
                    </li>
                @endif
                </li>
                <li><a href="{{ route('admin.edit', $user_login->id) }}"><i class="fa fa-gear fa-fw"></i> @lang('admin.user.profile')</a>
                </li>
                 <li><a href="{{ route('admin.changePass') }}"><i class="fa fa-fw"></i> @lang('admin.user.change_pass')</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out fa-fw"></i> @lang('admin.user.logout')</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    @include('admin.layout.menu')
    <!-- /.navbar-static-side -->
</nav>
