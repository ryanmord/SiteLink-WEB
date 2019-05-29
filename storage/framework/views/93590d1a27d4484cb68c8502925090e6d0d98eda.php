<?php
    $currentroutename = Route::currentRouteName();
    $action = Route::currentRouteAction();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title> <?php echo e(config('app.name')); ?> </title>

  <link rel="shortcut icon" href="<?php echo e(secure_asset('img/brick-wall.png')); ?>">
    <?php echo $__env->make('layouts.include_css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('css'); ?>
   
</head>

<!-- Body -->
<body>
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <div class="wrapper theme-6-active pimary-color-pink">

    <!-- Top Menu Items -->
    <?php echo $__env->make('layouts.main_topheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /Top Menu Items -->

    <!-- Left Sidebar Menu -->
    <?php echo $__env->make('layouts.main_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /Left Sidebar Menu -->
    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid pt-20">

            <?php echo $__env->yieldContent('main-content'); ?>

            <!-- Footer -->
        
            <!-- /Footer -->

        </div>
    </div>
    <!-- /Main Content -->

   <?php echo $__env->make('layouts.include_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php echo $__env->yieldContent('script'); ?>
</body>
<!-- /Body -->

</html>
