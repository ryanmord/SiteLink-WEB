<nav role="navigation" class="navbar navbar-custom">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button data-target="#bs-content-row-navbar-collapse-5" data-toggle="collapse" class="navbar-toggle" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Project Management</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
             <!--  <li class="active"><a href="getting-started.html">Getting Started</a></li>
              <li class="active"><a href="index.html">Documentation</a></li> -->
              <!-- <li class="disabled"><a href="#">Link</a></li> -->
              <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#"> {{ucfirst(session('loginusername'))}} <b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
                  <li style="text-align: center;"><a href="{{ url('/logout')}}"><span class="glyphicon glyphicon-off">Signout</span></a></li>
                </ul>
              </li>
            </ul>

          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>