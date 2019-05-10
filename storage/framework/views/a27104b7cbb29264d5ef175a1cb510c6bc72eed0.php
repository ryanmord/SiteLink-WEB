<?php echo $__env->make('frontlayouts.main_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<body id="page-top">



    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top " id="mainNav">
        <div class="container">
            <!-- #page-top -->
            <a class="navbar-brand js-scroll-trigger" href="<?php echo e(url('/home')); ?>"><img src="<?php echo e(asset('img/front/logo.png')); ?>"></a>
            <ul class="navbar-nav text-uppercase ml-auto head-left" id="login-menu">

                <li class="nav-item" id="aboutus-menu">
                    <a class="nav-link js-scroll-trigger" href="<?php echo e(url('/aboutus')); ?>">About Us
                    </a>
                </li>
                <li class="nav-item" id="howitworks-menu">
                    <a class="nav-link js-scroll-trigger" href="#">How It Works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="<?php echo e(url('/contactus')); ?>">Contact Us</a>
                </li>
            </ul>

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          MENU          <i class="fa fa-bars"></i>
        </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">

                    <li class="nav-item responsive-1">
                        <a class="nav-link js-scroll-trigger" href="<?php echo e(url('/aboutus')); ?>"> About Us            </a>
                    </li>

                    <li class="nav-item responsive-1">
                        <a class="nav-link js-scroll-trigger" href="#">How It Works       </a>
                    </li>

                    <li class="nav-item responsive-1">
                        <a class="nav-link js-scroll-trigger" href="<?php echo e(url('/contactus')); ?>">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?php echo e(url('/home/signUp')); ?>">Register</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link js-scroll-trigger" href="<?php echo e(url('/home/login')); ?>">Login</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
