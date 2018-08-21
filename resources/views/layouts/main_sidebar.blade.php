<div class="container-fluid">
    <!--documents-->
        <div class="row row-offcanvas row-offcanvas-left">
          <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            <ul class="list-group panel">
                <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>SIDE PANEL</b></li>
                <!-- <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li> -->
                <li class="list-group-item"><a href="{{ url('/dashboard')}}"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>
               
                <li class="list-group-item"><a href="{{ url('/users')}}"><i class="glyphicon glyphicon-user"></i>Associates and Schedulars </a></li>
               <li class="list-group-item"><a href="{{ url('/adminuser')}}"><i class="glyphicon glyphicon-user"></i>Admin Users </a></li>
              </ul>
          </div>