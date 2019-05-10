<?php echo $__env->make('frontlayouts.main_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body id="page-top">
  <!-- Navigation -->
    <?php echo $__env->make('frontlayouts.login_topheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Header -->
  <header class="masthead dashbord-screen">
    <div class="container">
      <div class="intro-text">
        <div class="row">
          <div class="col-md-7">
            <!-- <div class="owl-carousel owl-theme"> -->
              <div class="item">
                <div class="progress" data-percentage=<?php echo e($percentage); ?>>
                  <span class="progress-left">
                    <span class="progress-bar"></span>
                  </span>
                  <span class="progress-right">
                    <span class="progress-bar"></span>
                  </span>
                  <div class="progress-value project-data">
                    <div>
                      <span><?php echo e($user['totalproject']); ?></span>
                      <h3>Total</h3>
                    </div>
                  </div>
                </div>
                <div class="project-data">
                  <div class="col-md-4">
                    <h4><?php echo e($user['completedprojectcount']); ?></h4>
                    <h3>Jobs <br/> completed</h3>
                  </div>
                  <div class="col-md-4">
                    <h4><?php echo e($user['bidmadecount']); ?></h4>
                    <h3>Total <br/> Bids made</h3>
                  </div>
                  <div class="col-md-4">
                    <h4><?php echo e($user['overdueprojectcount']); ?></h4>
                    <h3>Overdue <br/> Projects</h3>
                  </div>
                </div>
              </div>
            <!-- </div> -->
          </div>
          <div class="col-md-5">
            <input type="hidden" name="pagenumber" id="pagenumber">
            <div class="notification-list">
              <h4>Notifications</h4>
              <?php if($datastatus != 0): ?>
               <ul id="notofication-list">
                <?php $i=1;?>
                <?php $__currentLoopData = $notification['notification']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($i % 2 == 0): ?>
                    <li class="even">
                  <?php else: ?>
                    <li class="odd">
                  <?php endif; ?> 
                    <?php if($value['readflag'] == 0): ?>
                      <span>
                      <i class="fa fa-circle" style="color: #fe5f55;float: left;"> 
                      </i><h5>&nbsp <?php echo e($value['projectname']); ?></h5> 
                        <div class="notification-date"><?php echo e($value['createddate']); ?>

                        </div>
                      </span>
                    <?php else: ?>
                      <span><h5>&nbsp <?php echo e($value['projectname']); ?></h5>
                        <div class="notification-date"><?php echo e($value['createddate']); ?>

                        </div>
                      </span>
                    <?php endif; ?>
                    <p> &nbsp <?php echo e($value['notificationtext']); ?></p>

                    <!--  1 for when new project is created nearby associate area then he can add bid for new project -->

                    <?php if($value['notificationflag'] == 1): ?>
                      <?php if($value['statusflag'] == 1): ?>
                        <input type="button" name="viewProjectbtn"  class="noti-btn" value="Add Bid" onclick="alertfunction()" notification-id="<?php echo e($value['notificationid']); ?>">
                        <?php else: ?>
                        <input type="button" name="viewProjectbtn" onclick="viewprojectdetail(<?php echo e($value['projectid']); ?>,<?php echo e($value['notificationid']); ?>)" class="noti-btn" value="Add Bid">
                      <?php endif; ?>

                    <!--  3 for when bid is accepted then associate can enter the status -->

                    <?php elseif($value['notificationflag'] == 3): ?>
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail(<?php echo e($value['projectid']); ?>,<?php echo e($value['notificationid']); ?>)" class="noti-btn" value="Add Note">
                      
                       <!--  4 for reject bid then associate can apply bid again -->

                    <?php elseif($value['notificationflag'] == 4): ?>
                      <?php if($value['statusflag'] == 1): ?>
                        <input type="button" name="viewProjectbtn"  class="noti-btn" value="Add Bid" onclick="alertfunction()" notification-id="<?php echo e($value['notificationid']); ?>">
                        <?php else: ?>
                        <input type="button" name="viewProjectbtn" onclick="viewprojectdetail(<?php echo e($value['projectid']); ?>,<?php echo e($value['notificationid']); ?>)" class="noti-btn" value="Add Bid">
                      <?php endif; ?>
                     <!--  6 for Schedular updated project details and asscoiate can add new bid -->

                    <?php elseif($value['notificationflag'] == 6): ?>
                      <?php if($value['statusflag'] == 1): ?>
                        <input type="button" name="viewProjectbtn"  class="noti-btn" value="Add Bid" onclick="alertfunction()" notification-id="<?php echo e($value['notificationid']); ?>">
                        <?php else: ?>
                        <input type="button" name="viewProjectbtn" onclick="viewprojectdetail(<?php echo e($value['projectid']); ?>,<?php echo e($value['notificationid']); ?>)" class="noti-btn" value="View Project">
                      <?php endif; ?>

                       <!--  7 for when project manager complete the project -->

                    <?php elseif($value['notificationflag'] == 7): ?>
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail(<?php echo e($value['projectid']); ?>,<?php echo e($value['notificationid']); ?>)" class="noti-btn" value="View Project"> 

                      <!--  8 for when project manager cancelled the project -->

                    <?php elseif($value['notificationflag'] == 8): ?>
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail(<?php echo e($value['projectid']); ?>,<?php echo e($value['notificationid']); ?>)" class="noti-btn" value="View Project"> 

                      <!--  11 for when project manager gives rating and review to associate -->


                    <?php elseif($value['notificationflag'] == 11): ?>
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail(<?php echo e($value['projectid']); ?>,<?php echo e($value['notificationid']); ?>)" class="noti-btn" value="View Rating"> 
                       <!--  12 for when project manager gives rating and review to associate -->


                    <?php elseif($value['notificationflag'] == 12): ?>
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail(<?php echo e($value['projectid']); ?>,<?php echo e($value['notificationid']); ?>)" class="noti-btn" value="View Note">

                     <!--  13 for when project manager do project is on hold -->
                       
                    <?php elseif($value['notificationflag'] == 13): ?>
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail(<?php echo e($value['projectid']); ?>,<?php echo e($value['notificationid']); ?>)" class="noti-btn" value="View Project" data-id="<?php echo e($value['projectid']); ?>" notification-id="<?php echo e($value['notificationid']); ?>"> 

                       <!--  14 for when project manager do project is in progress-->

                    <?php elseif($value['notificationflag'] == 14): ?>
                      <input type="button" name="viewProjectbtn" onclick="viewprojectdetail(<?php echo e($value['projectid']); ?>,<?php echo e($value['notificationid']); ?>)" class="noti-btn" value="View Project" data-id="<?php echo e($value['projectid']); ?>" notification-id="<?php echo e($value['notificationid']); ?>"> 
                    <?php endif; ?>
                  </li>
                  <?php $i++;?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
              <?php else: ?>
                <p>There are no Notification available</p>
              <?php endif; ?>
            </div>
          </div>    
        </div>    
      </div>
    </div>
  </header>
    <!-- Footer -->
  <?php echo $__env->make('frontlayouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('frontlayouts.include_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
  $(document).ready(function(){
      $("#login-menu").removeClass('active');
      $("#dashboard-menu").addClass('active');
      document.getElementById('pagenumber').value = 1;
    });
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            items:1,
            navigation:true,
            navigationText: [
                              "<i class='fa fa-chevron-left'></i>",
                              "<i class='fa fa-chevron-right'></i>"
                            ]
        })
    </script>
    
    <script>
  function alertfunction() {
  
  var projectid = $(this).attr('data-id');
    var notificationid = $(this).attr('notification-id');
     $.ajax({
            type: 'GET',
              url: '<?php echo route('readNotification'); ?>',
              data: {notificationid:notificationid},
              dataType: 'json',
          })

          .done(function(msg) {
         
              alert("Sorry!! This project is allocated so now you cannot send bid for this project.");
    });
  }
  function viewprojectdetail(projectid,notificationid)
  {
  
    
     $.ajax({
            type: 'GET',
              url: '<?php echo route('readNotification'); ?>',
              data: {notificationid:notificationid},
              dataType: 'json',
          })

          .done(function(msg) {
    });
    if(projectid != '')
    {
      
      url = '<?php echo url('/home/projects?projectid=') ?>';
      window.location.replace(url+projectid);
      
    }
   }
   $(".notification-list ul").scroll(function() {

        var $this = $(this);
        var pagenumber1 = document.getElementById('pagenumber').value;
        var pagenumber = ++pagenumber1;
        document.getElementById('pagenumber').value = pagenumber;
        $.ajax({
          type: 'GET',
            url: '<?php echo route('notificationPagination'); ?>',
            data: {pagenumber:pagenumber},
            dataType: 'json',
        success: function(data) {
          
          if(data.status == 1)
          {
            var results = $("#notofication-list");
            results.append(data.appendLi);
            pagenumber = pagenumber;
          }
          /*if(data.status == 0)
          {
            var pagenumber = --pagenumber1;
            document.getElementById('pagenumber').value = pagenumber;
          }*/
              
        }
      });
    });

  
    </script>

  </body>
</html>
