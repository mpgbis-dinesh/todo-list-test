<nav class="navbar-default navbar-static-side custom-sidebar-menu" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="top-menuli">&nbsp;</li>
            <li class="nav-header custom-header">
                <div class="dropdown profile-element text-center">
                    <span>
                        <a href="{{ URL::to('login') }}">To-Do Management</a>
                     </span>                    
                </div>
                <div class="logo-element">
                    {!! HTML::image("/assets/img/internachi-small-logo.jpg", "Logo", array( 'class' => 'img-size-small', 'width' => 55 )) !!}
                </div>
            </li>
            <!-- Menu items -->
            <li>
                <a href="{{ URL::to('login') }}"><i class="fa fa-home"></i><span class="nav-label">Home</span> </a>
            </li>

            <li>
                <a href="{{ URL::to('administration/user') }}"><i class="fa fa-user"></i><span class="nav-label">Users Management</span> </a>
            </li>
            <li>
                
            </li>


            <li class="">
                <a href="#"><i class="fa fa-group"></i> <span class="nav-label">Groups</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" style="height: 0px;">
                    <li><a href="{{ URL::to('administration/group-management/create') }}"><i class="fa fa-plus"></i><span class="nav-label">Create Group</span></a></li>
                    <li><a href="{{ URL::to('administration/group-management') }}"><span class="nav-label">All Groups</span> </a></li>
                </ul>
            </li>

            <li class="">
                <a href="#"><i class="fa fa-list"></i> <span class="nav-label">Tasks</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" style="height: 0px;">
                    <li><a href="{{ URL::to('administration/task-management/create') }}"><i class="fa fa-plus"></i><span class="nav-label">Create Tasks</span></a></li>
                    <li><a href="{{ URL::to('administration/task-management') }}"><i class="fa fa-list"></i><span class="nav-label">Tasks Management</span> </a></li>
                </ul>
            </li>
            <li>
                <a href="{{ URL::to('logout') }}">
                    <i class="fa fa-sign-out"></i><span class="nav-label">Log Out</span>
                </a>
            </li>            
        </ul>
    </div>
</nav>



<div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg custome-top-modification" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary toggleMenuOption" href="javascript:void(0);"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom">
                <div class="form-group">
                    <input type="text" placeholder="{{ date('l, F dS, Y') }}" class="form-control" name="top-search" id="top-search" readonly="">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                @if(Auth::check())
                    <li>
                        Welcome <span class="m-r-sm text-muted welcome-message">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                    </li>
                @endif

                <li>
                    <a href="{{ URL::to('logout') }}">
                        <i class="fa fa-sign-out"></i> Log Out
                    </a>
                </li>                
            </ul>
        </nav>
        </div>
        
        