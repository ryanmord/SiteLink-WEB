<?php $__env->startComponent('mail::message'); ?>

<?php if(! empty($greeting)): ?>
# <?php echo e($greeting); ?>

<?php else: ?>
<?php if($level == 'error'): ?>
# Whoops!
<?php else: ?>
# Hello!
<?php endif; ?>
<?php endif; ?>





<?php echo e($outroLines); ?>



<?php if(isset($actionText)): ?>
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
<?php $__env->startComponent('mail::button', ['url' => $actionUrl, 'color' => $color]); ?>
<?php echo e($actionText); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>



<!-- Salutation -->
<?php if(! empty($salutation)): ?>
<?php echo e($salutation); ?>

<?php else: ?>
Regards,<br><?php echo e(config('app.name')); ?> app team
<?php endif; ?>

<!-- Subcopy -->
<?php if(isset($actionText)): ?>
<?php $__env->startComponent('mail::subcopy'); ?>
If you’re having trouble clicking the "<?php echo e($actionText); ?>" button, copy and paste the URL below
into your web browser: [<?php echo e($actionUrl); ?>](<?php echo e($actionUrl); ?>)
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
