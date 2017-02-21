<!DOCTYPE html>
<html>
    <head>
        <base href="{{ asset('') }}" >
        <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="js/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <script type="text/javascript" language="javascript" src="ckeditor/ckeditor.js" ></script>
        <title>
            @if(isset($title))
                @lang('front.label.'.$title)
            @else
                @lang('front.title')
            @endif
        </title>
    </head>
    <body>
        <!-- navigation -->
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">@lang('front.title')</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar">
                     <ul class="nav navbar-nav">
                         <li>
                             <a href="{{ route('listReview') }}">@lang('front.label.review')</a>
                         </li>
                         <li>
                             <a href="{{ route('listBook') }}">@lang('front.label.book')</a>
                         </li>
                    </ul>
                    <div class="col-md-4">
                        <form action="{{ route('searchMember') }}" method="GET" class="navbar-form navbar-left" width="200">
                            <div class="input-group">
                                <input type="search" class="form-control" name="search" placeholder="@lang('front.label.search_member')" value="{{ isset($value) ? $value : '' }}" required="">
                                </br>
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            @if (isset($user_login))
                                <a href="{{ route('user.home') }}">
                                    <span class="glyphicon glyphicon-user"></span> Home
                            @endif
                                </a>
                        </li>
                        <li>
                            @if (isset($user_login))
                                <a href="{{ route('user.edit', $user_login->id) }}">
                                {{ $user_login->name }}
                            @endif
                                </a>
                        </li>
                        <li>
                            @if (isset($user_login))
                                <a href="{{ route('user.changePass') }}">
                                    @lang('front.label.change_pass')
                                </a>
                            @endif
                        </li>
                        <li>
                            @if (!isset($user_login))
                                <a href="{{ route('user.index') }}">
                                    @lang('front.label.login')
                                    <span class="glyphicon glyphicon-log-in"></span>
                                </a>
                            @endif    
                        </li>
                        <li>
                            @if (!isset($user_login))
                                <a href="{{ route('user.create') }}">
                                    @lang('front.label.signup')
                                </a>
                            @endif    
                        </li>
                        <li>
                            @if (isset($user_login))
                                <a href="{{ route('user.logout') }}">
                                    @lang('front.label.logout')
                                    <span class="glyphicon glyphicon-log-out"></span>
                                </a>
                            @endif    
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- end navigation -->
        <!-- Page content -->
        <!-- <div class="space50"></div> -->
        @yield('content')
        <!-- End container -->
    </body>
</html>
