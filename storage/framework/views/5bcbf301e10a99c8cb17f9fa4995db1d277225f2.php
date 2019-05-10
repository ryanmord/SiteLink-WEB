
<div class="container-fluid">
    <!--documents-->
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            <ul class="list-group panel" style="height: 700px;">
                <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>SIDE PANEL</b></li>
                <!-- <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li> -->
                <?php if(session('loginusertype') == 'admin'): ?>
                    <li class="list-group-item"><a href="<?php echo e(url('/dashboard')); ?>"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>
                    <li class="list-group-item" >
                        <a href="<?php echo e(url('/allProjects')); ?>"><i class="fa fa-building"></i>Projects</a>
                    </li>
                    <li class="list-group-item" >
                        <a href="<?php echo e(url('/archiveProjects')); ?>"><i class="fa fa-building"></i>Archive
                        </a>
                    </li>
                    <li class="list-group-item"><a href="<?php echo e(url('/users')); ?>"><i class="glyphicon glyphicon-user"></i>Assessors & Project Managers </a></li>
                    <!--  <li class="list-group-item"><a href="<?php echo e(url('/adminuser')); ?>"><i class="glyphicon glyphicon-user"></i>Admin Users </a></li> -->
                     <li class="list-group-item"><a href="<?php echo e(route('viewReport')); ?>"><i class="glyphicon glyphicon-list-alt"></i>Reports</a></li>
                    <li class="list-group-item"><a href="<?php echo e(url('/setSettings')); ?>"><i class="glyphicon glyphicon-cog"></i>Settings</a></li>
                <?php else: ?>
                    <li class="list-group-item"><a href="<?php echo e(url('/managerDashboard')); ?>"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>
                    <li class="list-group-item" >
                        <a href="<?php echo e(url('/allProjects')); ?>"><i class="fa fa-building"></i>Projects</a>
                    </li>
                    <li class="list-group-item" >
                        <a href="<?php echo e(url('/editUser')); ?>"><i class="fa fa-user"></i>My Profile</a>
                    </li>
                <?php endif; ?>
                <li class="list-group-item">
                </li>
            </ul>
        </div>