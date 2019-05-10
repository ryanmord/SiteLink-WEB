<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: left;margin-left: 50px;">Assign the category to associate
        </h4>
        <br>
      </div>
      <div class="modal-body">
        <?php if(isset($users) && !empty($users)): ?>
        <form role="form" class="form-horizontal" id="associateapprove" method="get" action="<?php echo e(route('authenticateUser')); ?>">
        <?php else: ?>
        <form role="form" class="form-horizontal" id="associateapprove" method="Post" action="#">
        <?php endif; ?>
          <?php echo e(csrf_field()); ?>

          <?php $__currentLoopData = $associatetype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $associate_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group">
              <div class="col-md-4">
                <div class="radio" style="text-align: left;">
                  <label><input type="radio" value="<?php echo e($associate_type->associate_type_id); ?>" name="optradio" checked>
                    &nbsp <?php echo e($associate_type->associate_type); ?></label>
                </div>
              </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <div class="form-group">
          <input type="hidden" name="userid" id="userid">
          <input type="hidden" name="status" id="status" value="1">
            <div>
              <button class="btn btn-success" style="width: 80px; float: left; 
              margin-right: 10px; margin-left: 10px; margin-bottom: 10px;" type="submit" id="approve">Approve</button>
              <button type="button" style="width: 80px; float: left; margin-bottom: 10px;" class="btn btn-danger" data-dismiss="modal">Close</button>  
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>