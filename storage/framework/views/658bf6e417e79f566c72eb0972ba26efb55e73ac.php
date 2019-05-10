
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> <?php echo e(config('app.name')); ?> </title>
 <!--  <link href="<?php echo e(asset('/css/themeCss/map.css')); ?>" rel="stylesheet"> -->
  <link rel="shortcut icon" href="<?php echo e(asset('img/brick-wall.png')); ?>">
 <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"> -->
 
    <?php echo $__env->make('layouts.include_css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css"> -->
  <link href="<?php echo e(asset('/css/frontCss/agency.css')); ?>" rel="stylesheet">
  
 
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
    <div class="loader" style="position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('<?php echo e(asset('img/Loader.gif')); ?>') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;"></div>
    <div class="page-wrapper">
      <div class="container-fluid pt-20">
      <div class="container">
        <div class="intro-text">
          <div class="row">
            <div class="col-xs-12 col-sm-9 content">
              <div class="panel panel-success" style="text-align: left;">
                <div class="panel-heading">
                  <div class="panel-title">
                    <b>Project Details</b>
                  </div>
                  <div class="panel-options">
                    <a class="bg" data-target="#sample-modal-dialog-1" data-toggle="modal" href="#sample-modal"><i class="entypo-cog"></i></a>
                    <a data-rel="collapse" href="#"><i class="entypo-down-open"></i></a>
                    <a data-rel="close" href="#!/tasks" ui-sref="Tasks"><i class="entypo-cancel"></i></a>
                  </div>
                </div>
                <div class="panel-body">
                  <header class="masthead dashbord-screen">
                    <div class="create-new-project">  
                      <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                          <div class="row" style="background-color: #E6E9ED;">
                            PROJECT INFORMATION
                          </div>
                          <div class="row">
                            <br>
                            <input type="hidden" name="project_id" id="project_id" value="<?php echo e($project['project_id']); ?>">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Project Name</label>
                            </div>
                            <div class="col-md-4">
                              <p style="font-size: 15px;"><?php echo e($project->project_name); ?></p>
                            </div>
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Project Identifier</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;"><?php echo e((!isset($project->project_number) || is_null($project->project_number)) ? '-' : $project->project_number); ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">On Site Date</label>
                            </div>
                            <div class="col-md-4">
                              <p style="font-size: 15px;"><?php echo e($onsitedate); ?></p>
                            </div>
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Report Due From Field</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;"><?php echo e($reportdate); ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">QAQC Date</label>
                            </div>
                            <div class="col-md-9">
                              <p style="font-size: 15px;"><?php echo e($qaqcDate); ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Latitude</label>
                            </div>
                            <div class="col-md-4">
                              <p style="font-size: 15px;"><?php echo e($project->latitude); ?></p>
                            </div>
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Longitude</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;"><?php echo e($project->longitude); ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Project Address</label>
                            </div>
                            <div class="col-md-9">
                              <p style="font-size: 15px;">
                              <a href="<?php echo e(url('siteAddress',$project['project_id'])); ?>" target="_blank" style="color: #DA4453;"><u><?php echo e($project->project_site_address); ?></u></a></p>
                              <input type="hidden" id="latitude" name="latitude" value="<?php echo e($project->latitude); ?>">
                              <input type="hidden" id="longitude" name="longitude" value="<?php echo e($project->longitude); ?>">
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Report Template</label>
                            </div>
                            <div class="col-md-9">
                              <p style="font-size: 15px;"><?php echo e($project->report_template); ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                              <label style="font-size: 15px;">Special Instruction</label>
                            </div>
                            <div class="col-md-9">
                              <p style="font-size: 15px;"><?php echo e((!isset($project->instructions) || is_null($project->instructions)) ? '-' : $project->instructions); ?></p>
                            </div>
                          </div>
                          <div class="row" style="background-color: #E6E9ED;">
                            PROPERTY INFORMATION
                          </div>
                          <div class="row">
                            <br>
                            <div class="col-md-2">
                              <label style="font-size: 15px;">Project Type</label>
                            </div>
                            <div class="col-md-9">
                              <p style="font-size: 15px;"><?php echo e($project->property_type); ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label style="font-size: 15px;">No. Units</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;"><?php echo e((!isset($project->no_of_units) || is_null($project->no_of_units)) ? '-' : $project->no_of_units); ?></p>
                            </div>
                            <div class="col-md-2">
                              <label style="font-size: 15px;">Sq. Footage</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;"><?php echo e((!isset($project->squareFootage) || is_null($project->squareFootage)) ? '-' : $project->squareFootage); ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label style="font-size: 15px;">No. Buildings</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;"><?php echo e((!isset($project->no_of_buildings) || is_null($project->no_of_buildings)) ? '-' : $project->no_of_buildings); ?></p>
                            </div>
                            <div class="col-md-2">
                              <label style="font-size: 15px;">Land Area</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;"><?php echo e((!isset($project->land_area) || is_null($project->land_area)) ? '-' : $project->land_area); ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label style="font-size: 15px;">No. Stories</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;"><?php echo e((!isset($project->no_of_stories) || is_null($project->no_of_stories)) ? '-' : $project->no_of_stories); ?></p>
                            </div>
                            <div class="col-md-2">
                              <label style="font-size: 15px;">Year Built</label>
                            </div>
                            <div class="col-md-2">
                              <p style="font-size: 15px;"><?php echo e((!isset($project->year_built) || is_null($project->year_built)) ? '-' : $project->year_built); ?></p>
                            </div>
                          </div>
                          <?php if(session('loginusertype') == 'admin'): ?>
                          <div class="row" style="background-color: #E6E9ED;">
                            BID INFORMATION
                          </div>
                          <div class="row">
                            <br>
                            <div class="col-md-2">
                              <label style="font-size: 15px;">Scope Budget</label>
                            </div>
                            <div class="col-md-9">
                               <?php 
                              $budget = number_format($project->budget, 2);
                              ?>
                              <p style="font-size: 15px;">$<?php echo e($budget); ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label style="font-size: 15px; text-align: left;" >Suggested Bid</label>
                            </div>
                            <div class="col-md-3">
                              <?php 
                              $suggestedbid = number_format($project->approx_bid, 2);
                              ?>
                              <p style="font-size: 15px;">$<?php echo e($suggestedbid); ?></p>
                            </div>
                          </div>
                          <?php endif; ?>
                          <div class="row" style="background-color: #E6E9ED;">
                            NOTIFICATIONS
                          </div>
                          <div class="row">
                            <br>
                            <div class="col-md-2">
                            <label style="font-size: 15px;">Scope</label>
                          </div>
                          <div class="col-md-9">
                            <?php
                            $temp = explode(",", $project['scope_performed_id']);
                            $count = count($temp);
                            $i = 1;
                            ?>
                            <p style="font-size: 15px;">
                            <?php $__currentLoopData = $scope; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if(in_array("$value->scope_performed_id", $temp)): ?>
                                <?php echo e($value->scope_performed); ?>

                                <?php if($i == $count): ?>
                              <?php else: ?>
                              ,&nbsp
                              <?php endif; ?>
                                 <?php $i++;?>

                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </p>
                        </div>
                      </div>
                      <?php if(isset($project->milesrange)): ?>
                      <div class="row">
                        <div class="col-md-2">
                          <label style="font-size: 15px;">Radius</label>
                        </div>

                        <div class="col-md-9">
                          <p style="font-size: 15px;"><?php echo e($project->milesrange); ?> Miles</p>
                        </div>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($project->employee_type_id)): ?>
                        <div class="row">
                          <div class="col-md-2">
                            <label style="font-size: 15px;">User Type</label>
                          </div>
                          <div class="col-md-9">
                          <?php
                            $temp = explode(",", $project['employee_type_id']);
                            $count = count($temp);
                            $i = 1;
                            ?>
                            <p style="font-size: 15px;">
                            <?php $__currentLoopData = $associateType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <?php if(in_array("$value->associate_type_id", $temp)): ?>
                                <?php echo e($value->associate_type); ?>

                                <?php if($i == $count): ?>
                              <?php else: ?>
                              ,&nbsp
                              <?php endif; ?>
                                 <?php $i++;?>

                              <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </p>
                          </div>
                          
                        </div>
                        <?php endif; ?>
                          <?php if($finalbid != 0): ?>
                          <div class="row">
                          <div class="col-md-12">
                          <div class="edit-btn">
                                <center>
                                  <button type="button" class="btn red-btn" data-toggle="modal" data-target="#associateprofile">Associate Profile</button>
                                  <button type="button" class="btn red-btn" data-toggle="modal" data-target="#project-status" id="view-status">View Notes</button>
                                </center>
                              </div>
                              <?php echo $__env->make('project.associate_profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </header>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if(session('loginusertype') == 'admin'): ?>
    <?php echo $__env->make('project.projectStatus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php else: ?>
    <?php if($holdstatus == 3): ?>
      <?php echo $__env->make('project.addprojectstatus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php else: ?>
      <?php echo $__env->make('project.projectStatus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
   <?php endif; ?>
   
  <script src="<?php echo e(asset('/js/themeJs/jquery-1.10.2.js')); ?>"></script>
  <script src="<?php echo e(asset('js/frontJs/jquery.validate.js')); ?>"></script>  
  <script src="<?php echo e(asset('js/themeJs/bootstrap.min.js')); ?>"></script>  
  <!-- <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </script> -->
  <script type="text/javascript">
    $(window).load(function() {
      $(".loader").fadeOut("slow");
      $("#place-div").hide();
      
    });
  $('#view-status').click(function(){
      var projectid = document.getElementById("project_id").value;
      document.getElementById('status_pagenumber').value = 1;
      $("#statuslist").empty();
     
     $.ajax({
            type: 'GET',
              url: '<?php echo route('view-Status'); ?>',
              data: {projectid:projectid},
              dataType: 'json',
          })

          .done(function(msg) {

            if(msg.status != 0)
            {
              $('#project-status-list').show();
              $('#statuslist').show();
              document.getElementById('no_any_status').style.display='none'; 
              var List = $('ul#statuslist');
             $.each(msg, function(i) {
                var li = $('<li/>')
                .appendTo(List);
                var h55 = $('<h5/>', {
                  text : msg[i].subject,
                 })
                  .appendTo(li);
                var pp = $('<p/>', {
                  text : msg[i].status,
                 })
                  .appendTo(li);
                 var pdate = $('<p/>', {
                  text : msg[i].createddate,
                 })
                  .appendTo(li);
              });
              $("#subject").text(msg[0].subject);
              $("#status").text(msg[0].status);
              $("#status_date").text(msg[0].createddate);
            }
            else
            {
              $('#statuslist').hide();
              $('#project-status-list').hide();
              document.getElementById('no_any_status').style.display='block'; 
            }
        });
    });
   //pagination for progress status list

        $("#project-status-list").scroll(function() {

        var $this = $(this);
        var pagenumber1 = document.getElementById('status_pagenumber').value;
        var pagenumber = ++pagenumber1;
        document.getElementById('status_pagenumber').value = '';
        document.getElementById('status_pagenumber').value = pagenumber;
        var projectid = document.getElementById("project_id").value;

        //var $results = $("#projectlist");
        //var pagenumber = 1;
        $.ajax({
          type: 'GET',
            url: '<?php echo route('status-Pagination'); ?>',
            data: {pagenumber:pagenumber,projectid:projectid},
            dataType: 'json',
       
        beforeSend: function(xhr) {
         /* $("#projectlist").after($("<li class='loading'>Loading...</li>").fadeIn('slow')).data("loading", true);*/
        },
        success: function(data) {
          //alert(data.status);
          if(data.status == 1)
          {
            var results = $("#statuslist");
            /*$(".loading").fadeOut('fast', function() {
                $(this).remove();

            });*/
            //var $data = $(data);
            //$data.hide();
            results.append(data.appendLi);
            //pagenumber = pagenumber;
            //$data.fadeIn();
            //$results.removeData("loading");
          }
          /*else
          {
            pagenumber = --pagenumber1;;
            
          }*/
          

            
        }
      });
    });
  </script>
  <script type="text/javascript">
    $('body').on('click','#add_status', function (event) {
    event.preventDefault(); 
    var projectid = document.getElementById("project_id").value;
    document.getElementById("project-id").value = projectid;
    $("#status-form").validate({

    rules: {
            statustxt: {
                required: true,
            },subjecttxt: { 
              required: true,
            },
          },messages:{
            subjecttxt: "Please Select Status",
            statustxt: "Please Enter Status Details",
            
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
      

  });
     if($("#status-form").valid()) {
      
        $.ajax({
            type: 'POST',
              url: $("#status-form").attr("action"),
              data: $('form#status-form').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
            var status = document.getElementById("statustxt").value;
            var subject = document.getElementById("subjecttxt").value;
            document.getElementById('no_any_status').style.display='none'; 
            $('#project-status-list').show();
            $('#statuslist').show();
            var List = $('ul#statuslist');
             var li = $('<li/>')
                .appendTo(List);
                var h55 = $('<h5/>', {
                  text : subject,
                 })
                  .appendTo(li);
                var pp = $('<p/>', {
                  text : status,
                 })
                  .appendTo(li);
          document.getElementById("statustxt").value = '';
          $('#subjecttxt').prop('selectedIndex',0);
          
        });

     }

    });
  </script>
</body>
</html>
                    
