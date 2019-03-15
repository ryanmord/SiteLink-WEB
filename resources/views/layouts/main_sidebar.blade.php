
<div class="container-fluid">
    <!--documents-->
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            <ul class="list-group panel" style="height: 700px;">
                <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>SIDE PANEL</b></li>
                <!-- <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li> -->
                @if(session('loginusertype') == 'admin')
                    <li class="list-group-item"><a href="{{ url('/dashboard')}}"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>
                    <li class="list-group-item" >
                        <a href="{{ url('/allProjects') }}"><i class="fa fa-building"></i>Projects</a>
                    </li>
                    <li class="list-group-item" >
                        <a href="{{ url('/archiveProjects') }}"><i class="fa fa-building"></i>Archive
                        </a>
                    </li>
                    <li class="list-group-item"><a href="{{ url('/users')}}"><i class="glyphicon glyphicon-user"></i>Associates & Project Managers </a></li>
                    <!--  <li class="list-group-item"><a href="{{ url('/adminuser')}}"><i class="glyphicon glyphicon-user"></i>Admin Users </a></li> -->
                     <li class="list-group-item"><a href="{{ route('viewReport') }}"><i class="glyphicon glyphicon-list-alt"></i>Reports</a></li>
                    <li class="list-group-item"><a href="{{ url('/setSettings') }}"><i class="glyphicon glyphicon-cog"></i>Settings</a></li>
                @else
                    <li class="list-group-item"><a href="{{ url('/managerDashboard')}}"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>
                    <li class="list-group-item" >
                        <a href="{{ url('/projectList') }}"><i class="fa fa-building"></i>Projects</a>
                    </li>
                    <li class="list-group-item" >
                        <a href="{{ url('/editUser') }}"><i class="fa fa-user"></i>My Profile</a>
                    </li>
                @endif
                <li class="list-group-item">
                </li>
            </ul>
        </div>