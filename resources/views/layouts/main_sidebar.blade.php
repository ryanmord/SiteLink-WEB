<div class="container-fluid">
    <!--documents-->
  <div class="row row-offcanvas row-offcanvas-left">
    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
      <ul class="list-group panel">
        <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>SIDE PANEL</b></li>
                <!-- <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li> -->
        <li class="list-group-item"><a href="{{ url('/dashboard')}}"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>
        <li class="list-group-item"><a href="{{ url('/users')}}"><i class="glyphicon glyphicon-user"></i>Associates & Project Managers </a></li>
        <li class="list-group-item"><a href="{{ url('/adminuser')}}"><i class="glyphicon glyphicon-user"></i>Admin Users </a></li>
        <li>
          <a href="#demo4" class="list-group-item " data-toggle="collapse"><i class="fa fa-building"></i>Projects</a>
                    <!-- <li class="collapse" id="demo4">
                      <a href="{{ url('/allocatedProject') }}" class="list-group-item"><i class="fa fa-building-o"></i>Allocated Projects</a>
                      <a href="{{ url('/nonAllocatedProject') }}" class="list-group-item"><i class="fa fa-building-o"></i>Non Allocated Projects</a>
                      <a href="#" class="list-group-item"><i class="fa fa-building-o"></i>In Progress Project</a>
                      <a href="{{ url('/completedProject') }}" class="list-group-item"><i class="fa fa-building-o"></i>Completed Project</a>
                      <a href="{{ url('/cancelledProject') }}" class="list-group-item"><i class="fa fa-building-o"></i>Cancelled Project</a>
                    </li> -->
                </li>
        <li class="list-group-item"><a href="{{ url('/setSettings') }}"><i class="glyphicon glyphicon-cog"></i>Settings</a></li>
      </ul>
    </div>