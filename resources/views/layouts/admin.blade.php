<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Laravel Mock Test Admin</title>
        <!-- Bootstrap Core CSS -->
        <link href="{{asset('public/theme/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="{{asset('public/theme/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
        @yield('styles')
        <!-- Custom CSS -->
        <link href="{{asset('public/theme/dist/css/sb-admin-2.css')}}" rel="stylesheet">
        <!-- Morris Charts CSS -->
        <link href="{{asset('public/theme/vendor/morrisjs/morris.css')}}" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="{{asset('public/theme/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Laravel Mock Test</a>
                </div>
                <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-right">
                    <!-- /.dropdown -->
                    <li class="dropdown nav-item menu-lag">
                        <a class="nav-link nav-link" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe fa-check" aria-hidden="true"></i></a>
                        <div class="dropdown-menu dropdown-menu-right flag-drop">           
                            <a class="dropdown-item @if(session()->get('locale') == 'en' || empty(session()->get('locale'))) active @endif" href="{{url('changeLanguage/en')}}">
                                English
                            </a>
                            <a class="dropdown-item @if(session()->get('locale') == 'in') active @endif" href="{{url('changeLanguage/in')}}">
                            हिंदी</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i>{{ __('messages.user_profile') }}</a>
                            </li>

                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> {{ __('messages.settings') }}</a>
                            </li>
                            <li class="divider"></li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i> 
                            {{ __('messages.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        </ul>
                    </li>
                <!-- /.dropdown-user -->
                <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="{{ url('dashboard') }}"><i class="fa fa-dashboard fa-fw"></i>{{ __('messages.dashboard') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('section') }}"><i class="fa fa-list-alt fa-fw"></i>{{ __('messages.sections') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('examination') }}"><i class="fa fa-book  fa-fw"></i>{{ __('messages.examinations') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('mock-test') }}"><i class="fa fa-pencil fa-fw"></i>{{ __('messages.mock_tests') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('categories') }}"><i class="fa fa-list-alt fa-fw"></i>{{ __('messages.categories') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('directions') }}"><i class="fa fa-list-alt fa-fw"></i>{{ __('messages.direction_guidelines') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('questions') }}"><i class="fa fa-list-alt fa-fw"></i>{{ __('messages.questions') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('packages') }}"><i class="fa fa-list-alt fa-fw"></i>{{ __('messages.package') }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>
            <div id="page-wrapper">
                @yield('content')
            </div>
        <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- jQuery -->
        <script src="{{asset('public/theme/vendor/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{{asset('public/theme/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{asset('public/theme/vendor/metisMenu/metisMenu.min.js')}}"></script>
        <!-- Morris Charts JavaScript -->
        <script src="{{asset('public/theme/vendor/raphael/raphael.min.js')}}"></script>
        <script src="{{asset('public/theme/vendor/morrisjs/morris.min.js')}}"></script>
        <script src="{{asset('public/theme/data/morris-data.js')}}"></script>
        <!-- Custom Theme JavaScript -->
        <script src="{{asset('public/theme/dist/js/sb-admin-2.js')}}"></script>
        @yield('scripts')
    </body>
</html>
