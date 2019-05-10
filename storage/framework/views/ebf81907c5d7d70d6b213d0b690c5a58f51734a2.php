<?php echo $__env->make('frontlayouts.main_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body id="page-top">


    <!-- Navigation -->
 <?php if(session('associateId')): ?>
    <?php echo $__env->make('frontlayouts.login_topheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>
<?php echo $__env->make('frontlayouts.topheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text home-text">
                <div class="intro-heading text-uppercase">BUILD YOUR DREAM HOME</div>
                <div class="intro-lead-in">Professionals, here to help</div>
               
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="<?php echo e(route('AssociateLogin')); ?>">Signin as Associate</a>
                <div class="download-here">Download The App Here</div>
                <div class="col-sm-6 qr-code qr-left">
                     <a href="javascript:void(0);"><img src="<?php echo e(asset('img/front/android.png')); ?>"></a>
                 
                </div>
                <div class="col-sm-6  qr-code">
                    <a href="javascript:void(0);"> <img src="<?php echo e(asset('img/front/ios.png')); ?>">
                    </a>
                
                </div>
            </div>
        </div>
    </header>
    <!-- Services -->
    <!-- Footer -->
    <?php echo $__env->make('frontlayouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('frontlayouts.include_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>

</html>