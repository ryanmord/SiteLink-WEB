<nav class="navbar navbar-expand-lg navbar-dark fixed-top " id="mainNav">
    <div class="container">
        <!-- #page-top -->
        <a class="navbar-brand js-scroll-trigger" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('img/front/logo.png')); ?>"></a>
        <ul class="navbar-nav text-uppercase ml-auto head-left">
            <li class="nav-item" id="aboutus-menu">
                <a class="nav-link js-scroll-trigger" href="<?php echo e(route('aboutus')); ?>">About Us</a>
            </li>
            <li class="nav-item"  id="howitworks-menu">
                <a class="nav-link js-scroll-trigger" href="<?php echo e(route('howitworks')); ?>">How It Works</a>
            </li>
            <li class="nav-item" id="contactus-menu">
                <a class="nav-link js-scroll-trigger" href="<?php echo e(route('contactus')); ?>">Contact Us
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                MENU         
         <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto" id="login-menu">
                <li class="nav-item responsive-1" id="aboutus-menu">
                    <a class="nav-link js-scroll-trigger" href="<?php echo e(route('aboutus')); ?>">About Us
                    </a>
                </li>
                <li class="nav-item responsive-1" id="howitworks-menu">
                    <a class="nav-link js-scroll-trigger" href="<?php echo e(route('howitworks')); ?>">How It Works  </a>
                </li>
                <li class="nav-item responsive-1" id="contactus-menu">
                    <a class="nav-link js-scroll-trigger" href="<?php echo e(route('contactus')); ?>">Contact Us</a>
                </li>
                <li class="nav-item" id="register-menu">
                    <a class="nav-link js-scroll-trigger" href="<?php echo e(url('/home/signUp')); ?>">Register</a>
                </li>
                <li class="nav-item" id="userlogin-menu">
                    <a class="nav-link js-scroll-trigger" href="<?php echo e(url('/home/login')); ?>">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>