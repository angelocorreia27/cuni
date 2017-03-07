<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>ADM</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">ADM {{ trans('adminlte_lang::message.app_name') }}, LDA </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                
                
                
                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                    <!-- User Account Menu-->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            @if(Auth::user()->avatar)
                                <img  src="/uploads/{{Auth::user()->avatar}}" class="user-image" alt="Cinque Terre" >
                            @else
                                <img  src="{{ asset('/img/user2-160x160.jpg') }}" class="user-image" alt="Cinque Terre" >
                            @endif
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                @if(Auth::user()->avatar)
                                    <img  src="/uploads/{{Auth::user()->avatar}}" class="img-circle" alt="Cinque Terre" >
                                @else
                                    <img  src="{{ asset('/img/user2-160x160.jpg') }}" class="img-circle" alt="Cinque Terre" >
                                @endif
                               <p>
                                    {{ Auth::user()->name }}
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body" style="padding: 5px;">
                            <a href="{{ url('auth/profile') }}"><i class="fa fa-user"></i> {{ trans('adminlte_lang::message.profile') }}</a>
                               
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat"><i class="fa fa-lock"></i> {{ trans('adminlte_lang::message.lock') }}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> {{ trans('adminlte_lang::message.signout') }}</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                  
                @endif

                <!-- Control Sidebar Toggle Button -->
                <!--<li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>-->
            </ul>
        </div>
    </nav>
</header>
