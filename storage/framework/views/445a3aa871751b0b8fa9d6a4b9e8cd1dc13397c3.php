<?php
    $currentroutename = Route::currentRouteName();
    $action = Route::currentRouteAction();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="<?php echo e(asset('img/front/fav-logo.png')); ?>" type="image/png" sizes="16x16">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo e(config('app.name')); ?></title>
       <link href="<?php echo e(asset('/css/frontCss/front_font.css')); ?>" rel="stylesheet" type="text/css">
    <meta name="csrf-param" content="_csrf-frontend">
    <meta name="csrf-token" content="fkMSpKSo6hiL4aMtehZ6vsKrITZzXRMTNqJcc08Vjbn4x2CqKYTaK9bADjir9ZlwWVCoNVE0zG0Bn_VUB-ywPA==">
    <title></title>

  <link rel="shortcut icon" href="<?php echo e(asset('img/brick-wall.png')); ?>">
    <?php echo $__env->make('frontlayouts.include_css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
    <?php echo $__env->make('frontview.dashboard.settings', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- Body -->

