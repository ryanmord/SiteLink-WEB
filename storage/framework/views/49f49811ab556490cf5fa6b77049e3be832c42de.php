
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> <?php echo e(config('app.name')); ?> </title>
 <!--  <link href="<?php echo e(asset('/css/themeCss/map.css')); ?>" rel="stylesheet"> -->
  <link rel="shortcut icon" href="<?php echo e(asset('img/brick-wall.png')); ?>">
  <?php echo $__env->make('layouts.include_css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <link href="<?php echo e(asset('/css/frontCss/agency.css')); ?>" rel="stylesheet">
    <!-- <script src="<?php echo e(asset('/js/themeJs/notification.js')); ?>"></script> -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link href="<?php echo e(asset('/css/themeCss/map.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('/js/themeJs/jquery-1.10.2.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/themeJs/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/themeJs/bootstrap-select.min.js')); ?>"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
 
  <!-- <link href="<?php echo e(asset('/css/jquery.multiselect.css')); ?>" rel="stylesheet"/> -->
    <script>

    $(function() {

      $( "#onsitedate" ).datepicker({
         minDate: 0 
      });
    
    });
    </script>
    <script>
      $(function() {
        $( "#reportdate" ).datepicker(
        {
          minDate: 0 
        });
      });
    </script>
    <script>
      $(function() {
        $( "#qaqcDate" ).datepicker(
        {
           
        });
      });
    </script>
 
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
                    <b>Update Project</b>
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
                          </div><br>
                          <form class="new-project" id="editproject" action="<?php echo e(url('updateProject/'.$project->project_id)); ?>">
                              <?php echo e(csrf_field()); ?>

                              <div class="row">
                                <div class="form-group col-md-2">
                                  <br>
                                  <label class="required">Project Name</label>
                                </div>
                                <div class="form-group col-md-3">
                                  <input type="text" name="projectname" value="<?php echo e($project->project_name); ?>" placeholder="Project Name" required="">
                                 
                                  </div>
                                    <div class="form-group col-md-2">
                                      <br>
                                      <label class="required">Project Identifier</label>
                                    </div>
                                    <div class="form-group col-md-3 <?php echo e($errors->has('identifier') ? ' has-error' : ''); ?>">
                                      <input type="text" name="identifier" id="identifier" value="<?php echo e($project->project_number); ?>" placeholder="Project Identifier" autocomplete="off">
                                    </div>  
                                </div>
                              <div class="row">
                                 <div class="form-group col-md-2">
                                    
                                    <label class="required">Report Due From Field</label>
                                  </div>
                                  <div class="form-group col-md-3 <?php echo e($errors->has('reportdate') ? ' has-error' : ''); ?>">
                                    <input type="text" name="reportdate" id="reportdate" value="<?php echo e($reportdate); ?>" placeholder="Report Due Date" autocomplete="off">
                                    <i class="fa fa-calendar" aria-hidden="true">
                                    </i>
                                  </div>
                                  <div class="form-group col-md-2">
                                    <br>
                                    <label>On Site Date</label>
                                  </div>
                                  <div class="form-group col-md-3">
                                    <input type="text" name="onsitedate" id="onsitedate" value="<?php echo e($onsitedate); ?>" placeholder="On Site Date" autocomplete="off">
                                    <i class="fa fa-calendar" id="datepickericon"></i>
                                  </div>
                              </div>
                          <div class="row">
                            <div class="form-group col-md-2">
                                <br>
                                <label>QAQC Date</label>
                              </div>
                              <div class="form-group col-md-3">
                                <input type="text" name="qaqcDate" id="qaqcDate" value="<?php echo e($qaqcDate); ?>" placeholder="QAQC Date" autocomplete="off">
                                <i class="fa fa-calendar" id="datepickericon"></i>
                              </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-2">
                                  <br>
                                  <label class="required">Site Address</label>
                                </div>
                                <div class="form-group col-md-6">
                                  <input type="text" name="siteaddress" readonly="" id="address" value="<?php echo e($project->project_site_address); ?>" placeholder="site Address" data-toggle="modal" data-target="#myModal" required="">
                                  <input type="hidden" id="latitude" name="latitude" value="<?php echo e($project->latitude); ?>">
                                  <input type="hidden" id="longitude" name="longitude" value="<?php echo e($project->longitude); ?>">
                                </div>
                                <div class="form-group col-md-2">
                                  <br>
                                  <li style="color: #DA4453;" data-toggle="modal" data-target="#myModal"><a href="#">set address</a></li>
                                    <?php echo $__env->make('project.demomap', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   
                                </div>
                          </div>
                         
                          <div class="row">
                            <div class="form-group col-md-2">
                                <br>
                                <label class="required">Report Template</label>
                              </div>
                              <div class="form-group col-md-8">
                                <input type="text" name="template" value="<?php echo e($project->report_template); ?>" placeholder="Report template" required="">
                              </div>
                          </div>
                          <div class="row">
                             <div class="form-group col-md-2"  field-customers-first_name>
                                <br>
                                <label>Special Instructions</label>
                              </div>
                              <div class="form-group col-md-8">
                                <input type="text" name="instruction" id="instruction" value="<?php echo e($project->instructions); ?>" placeholder="Special instruction">
                              </div>
                          </div>
                          <div class="row" style="background-color: #E6E9ED;">
                            PROPERTY INFORMATION
                          </div>
                          <div class="row">
                            <br>
                            <div class="form-group col-md-2"  field-customers-first_name>
                                <br>
                                <label class="required">Project Type</label>
                              </div>
                              <div class="form-group col-md-8">
                                <input type="text" name="projectType" id="projectType" placeholder="Project Type" id="projectType" value="<?php echo e($project->property_type); ?>" required="">
                              </div>
                          </div>
                          <div class="row">
                          
                            <div class="form-group col-md-2">
                              <br>
                                <label>No. Units</label>
                              </div>
                              <div class="form-group col-md-3">
                                <input type="text" name="units_txt" id="units_txt" value="<?php echo e($project->no_of_units); ?>"  placeholder="  No.of units" style="padding-left: 12px;">
                                
                              </div>
                               <div class="form-group col-md-2">
                                <br>
                                <label>Sq. Footage</label>
                              </div>
                                <?php 
                                $squareFootage = number_format($project->squareFootage, 2);
                                $squareFootage = str_replace(',', '', $squareFootage);
                              ?>
                              <div class="form-group col-md-3">
                                <input type="text" name="footage_txt" id="footage_txt" placeholder="  Sq. Footage" value="<?php echo e($squareFootage); ?>" style="padding-left: 12px;">
                              </div>
                          </div>
                          <div class="row">
                          
                            <div class="form-group col-md-2">
                                <br>
                                <label>No. Buildings</label>
                              </div>
                              <div class="form-group col-md-3">
                                <input type="text" name="building_txt" id="building_txt"  placeholder="  No.Buildings" value="<?php echo e($project->no_of_buildings); ?>" style="padding-left: 12px;">
                                
                              </div>
                               <div class="form-group col-md-2">
                                <br>
                                <label>Land Area</label>
                              </div>
                              <div class="form-group col-md-3">
                                <input type="text" name="area_txt" id="area_txt"placeholder="  Land Area" value="<?php echo e($project->land_area); ?>" style="padding-left: 12px;">
                              </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-2">
                                <br>
                                <label>No. Stories</label>
                              </div>
                              <div class="form-group col-md-3">
                                <input type="text" name="stories_txt" id="stories_txt"  placeholder="  No. Stories" value="<?php echo e($project->no_of_stories); ?>" style="padding-left: 12px;">
                              </div>
                               <div class="form-group col-md-2">
                                <br>
                                <label>Year Built</label>
                              </div>
                              <div class="form-group col-md-3">
                                <input type="text" name="built_txt" id="built_txt" placeholder="  Year Built" value="<?php echo e($project->year_built); ?>" style="padding-left: 12px;" maxlength="4">
                              </div>
                          </div>
                          <div class="row" style="background-color: #E6E9ED;">
                            BID INFORMATION
                          </div>
                          <div class="row">
                          <br>
                             <div class="form-group col-md-2">
                                <br>
                                <label class="required">Budget</label>
                              </div>
                              <div class="form-group col-md-3">
                                <?php 
                              $budget = number_format($project->budget, 2);
                              ?>
                                <input type="text" name="budget_txt" id="budget_txt" placeholder="  Budget" value="<?php echo e($budget); ?>" required="" style="padding-left: 12px;">
                                <i class="glyphicon glyphicon-usd form-control-feedback" style="left: 0; line-height: 27px;"></i>
                              </div>
                               <div class="form-group col-md-2">
                                <br>
                                <label class="required">Suggested Bid</label>
                              </div>
                              <div class="form-group col-md-3">
                                <?php 
                              $approx_bid = number_format($project->approx_bid, 2);
                              ?>
                                <input type="text" name="projectbid" id="projectbid" placeholder="  Suggest a bid" value="<?php echo e($approx_bid); ?>" required="" style="padding-left: 12px;">
                                <i class="glyphicon glyphicon-usd form-control-feedback" style="left: 0; line-height: 27px;"></i>
                              </div>
                          </div>
                          <div class="row" style="background-color: #E6E9ED;">
                            NOTIFICATIONS
                          </div>
                          <div class="row">
                          <br>
                           <div class="form-group col-md-2">
                                <br><br><br>
                                <label class="required">Scope(s)</label>
                              </div>
                              <?php
                                $temp = explode(",", $project['scope_performed_id']);
                              ?>
                              <div class="form-group col-md-9">
                               <?php $__currentLoopData = $scope; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(in_array("$value->scope_performed_id", $temp)): ?>
                                  <label class="checkbox" style="color: grey;">
                                    <input type="checkbox" value="<?php echo e($value->scope_performed_id); ?>" name="scopeperformedid[]" id="scope_performed" checked>
                                    <?php echo e($value->scope_performed); ?> 
                                  </label>
                                <?php else: ?> 
                                  <label class="checkbox" style="color: grey;">
                                    <input type="checkbox" value="<?php echo e($value->scope_performed_id); ?>" name="scopeperformedid[]" id="scope_performed">
                                    <?php echo e($value->scope_performed); ?> 
                                  </label>
                                <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <label id="scopeperformedid[]-error" class="error" for="scopeperformedid[]" style="color: #b70a0a;"></label>
                                <!-- <input type="hidden" id="scopeid" name="scopeid" value=""> -->
                             
                              </div>
                              <!-- <div id="err"></div> -->
                          </div>
                          <div class="row">
                            <div class="form-group col-md-2">
                                <br><br>
                                <label class="required">Miles Range</label>
                              </div>
                              <div class="form-group col-md-8">
                                <output style="float: left;">Radius&nbsp</output>
                                <output name="miles" id="miles" style="float: left;">
                                <?php echo e($project->milesrange); ?></output>
                                <output style="float: left;">&nbspMILES</output>
                                <input type="range" name="milesrange" id="milesrange" value="<?php echo e($project->milesrange); ?>" min="<?php echo e($minvalue); ?>" max="<?php echo e($maxvalue); ?>" oninput="miles.value = milesrange.value">
                                <output name="minmiles" id="minmiles" style="float: left;"><?php echo e($minvalue); ?> MILES</output>
                                <output name="maxmiles" id="maxmiles" style="float: right;"><?php echo e($maxvalue); ?> MILES</output>
                                <br>
                                <br>
                              </div>
                          </div>
                          <div class="row">
                          <?php
                            $temp = explode(",", $project['employee_type_id']);
                          ?>
                          <div class="form-group col-md-2">
                                <br>
                                <label class="required">User Type</label>
                              </div>
                              <!-- select associate type -->
                              <div class="form-group col-md-9">
                                 <?php $__currentLoopData = $associatetype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(in_array("$value->associate_type_id", $temp)): ?>
                                  <label class="checkbox" style="color: grey;">
                                    <input type="checkbox" value="<?php echo e($value->associate_type_id); ?>" name="associatetypeid[]" id="associatetypeid[]" checked>
                                    <?php echo e($value->associate_type); ?> 
                                  </label>
                                  <?php else: ?>
                                    <label class="checkbox" style="color: grey;">
                                    <input type="checkbox" value="<?php echo e($value->associate_type_id); ?>" name="associatetypeid[]" id="associatetypeid[]">
                                    <?php echo e($value->associate_type); ?> 
                                  </label>
                                  <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 <label id="associatetypeid[]-error" class="error" for="associatetypeid[]" style="color: #b70a0a;"></label>
                             
                              </div>
                              <!-- <div id="err"></div> -->
                          </div>
                          
                          <div class="row">
                              <div class="form-group col-md-2">
                                
                                <label id="selectIdLabel">Select Individual(s)</label>
                              </div>
                              <!-- select associate type -->
                              <div class="form-group col-md-8">
                               <a href="#associate-list" data-toggle="modal"><u style="color: #fe5f55;" id="add-individuals">+ Add Individual(s)</u>
                               </a>
                              </div>
                              <?php echo $__env->make('project.asscociatelist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                              <!-- <div id="err"></div> -->
                              </div>
                              <div class="row" id="userName-div">
                                <div class="form-group col-md-2">
                                  <!-- <label id="selectIdLabel">Selected Individual(s)</label> -->
                                </div>
                                <!-- select associate type -->
                                <div class="form-group col-md-8">
                                <div class="table-responsive" style="max-height: 100px;overflow: auto;">
                                 <table class="table table-bordered table-hover table-striped">
                                    <tbody id="associateNames">
                                  </tbody></table></div>
                                </div>
                              </div>
                      
                        <div class="row">
                          <div class="form-group col-md-3">
                            </div>
                              <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-success" id="saveproject"> Update   
                            </button>
                              </div>
                              
                        </div>
                        </form>
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
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFesVLN0rhPhI0uHrMrQjclKdbyx9X9g0&libraries=places&callback=initMap"
        async defer></script>  
  <script src="<?php echo e(asset('/js/themeJs/map.js')); ?>"></script>
  <script src="<?php echo e(asset('/js/themeJs/1_12_1_jquery.js')); ?>"></script>
  <script src="<?php echo e(asset('js/frontJs/jquery.validate.js')); ?>"></script>  
    
  </script>
 <script type="text/javascript">
    $(window).load(function() {
      $(".loader").fadeOut("slow");
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#userName-div').hide();
    //called when key is pressed in textbox
    $("#projectbid").keypress(function (e) {
      $('#projectbid').keyup(function(e) {
        if ($(this).val().indexOf('.') == 0 || $(this).val().indexOf('0') == 0) {
          $(this).val($(this).val().substring(1));
          }
        });
      });
    });
  </script>
 
  <script>
    document.getElementById("editproject").onkeypress = function(e) {
      var key = e.charCode || e.keyCode || 0;     
      if (key == 13) {
        e.preventDefault();
        return false;
      }
    }
    $(document).ready(function() {
      document.getElementById("pagenumber").value = 1;
      document.getElementById("associate-ids").value = 0;
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          return false;
        }
      });
    });
    $(document).ready(function () {

      $('body').on('click','#saveproject', function (event) {
      event.preventDefault(); 
    /*var date = new Date();
    var todaydate= (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear();
  */
    $("#editproject").validate({
          rules: {
            projectname: {
                required: true,
            },siteaddress: {
                required: true,
            },managerid: { 
              required: true,
            },reportdate: { 
                required: true,
                
            },template:{
                required: true,
               
            },
            identifier:{
                required: true,
               
            },selectmanger:{
                required: true,
               
            },projectbid:{
              required: true,
            },
            'scopeperformedid[]': 
            {
              required: true, 
              minlength: 1 
            },
            'associatetypeid[]': 
            {
              required: true, 
              minlength: 1 
            },
            "scopeperformedid[]": "required"
        },messages:{
            projectname: "Please Enter Project Name",
            siteaddress: "Please Set The Site Address",
            managerid: "Please Select Manager",
            reportdate:{
              required : "Please Set Report Due From Field",
              
            },
            template:"Please Enter Template",
            identifier:"Please Enter Project Identifier",
            projectType:"Please Enter Project Type",
            budget_txt:"Please Enter Budget",
            selectmanger:"Please Select Manager",
            projectbid:{
              required : "Please Enter Project Bid",
              number :"Please enter numeric value"
            },
            
            "associatetypeid[]": "Please select Employee Type",
            "scopeperformedid[]": "Please select scope performed"
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }

  });
    if($("#editproject").valid()) {
   
        
       /* checks = $('input[type="checkbox"]:checked').map(function(){
              return $(this).val();
                }).get();
        document.getElementById("scopeid").value = checks;*/
        $(".loader").fadeIn("slow");
        jQuery.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
        });
        $.ajax({
            type: 'put',
              url: $("#editproject").attr("action"),
              data: $('form#editproject').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
          $(".loader").fadeOut("slow");
          alert("Project Updated Successfully");
          url = '<?php echo route('allProjects'); ?>';
          window.location.replace(url);
          
        });
      }

    });
  });
</script>
<script type="text/javascript">
  jQuery(document).ready(function(){
      $('form')
      .each(function() {
        $(this).data('serialized', $(this).serialize())
      })
      .on('change input', 'input, select, textarea,checkbox', function(e) {
          var $form = $(this).closest("form");
          var state = $form.serialize() === $form.data('serialized');    
          $form.find('input:submit, button:submit').prop('disabled', state);
    
      //Do stuff when button is DISABLED
     
    //OR use shorthand as below
    //$("#demo").toggle(!state);
})
.find('input:submit, button:submit')
.prop('disabled', true);
});
$('#cancel-user').click(function(){
    document.getElementById("associate-ids").value = '';
    document.getElementById('pagenumber').value = 1;
  });
  $('#add-individuals').click(function(){
    document.getElementById('pagenumber').value = 1;
    var checks = $('input[name="associateid[]"]:checked').map(function(){
              return $(this).val();
                }).get();
    document.getElementById("associate-ids").value = checks;
    var checks = document.getElementById("associate-ids").value;
    $.ajax({
            type: 'GET',
            url: '<?php echo route('searchAssociate'); ?>',
            data: {selectedAssociate:checks,pagenumber:1,limit:6},
            dataType: 'json',
          })

          .done(function(response) {
            if(response != '')
            {
              $('#usertable').html('');
              $('#no_any_user').hide();
              $('#div-button').show();
              $('#associatetable').show();
              $('#usertable').append(response);
            }
            else
            {
              $('#associatetable').hide();
              $('#div-button').hide();
              $('#no_any_user').show();
            }
        });
    }); 
   $('#add-individuals-users').click(function(){
  
    var idvalue = document.getElementById("associate-ids").value;
    $('#selectIdLabel').html('Selected Individuals').show();
    var checks = $('input[name="associateid[]"]:checked').map(function(){
              return $(this).val();
                }).get();
    
   if(checks != "")
    {
      document.getElementById("associate-ids").value = checks;
    }
    
    var checks = document.getElementById("associate-ids").value;

    $.ajax({
            type: 'GET',
            url: '<?php echo route('getAssociatesName'); ?>',
            data: {selectedAssociate:checks},
            dataType: 'json',
          })

          .done(function(response) {
            if(response != '')
            {
              $('#userName-div').show();
              $('#associateNames').html('');
              $('#associateNames').append(response);
            }
          });
    
  }); 
    $("#search-user").keyup(function () {
    var idvalue = document.getElementById("associate-ids").value;

    var checks = $('input[name="associateid[]"]:checked').map(function(){
              return $(this).val();
                }).get();
    
    if(idvalue === "")
    {
      document.getElementById("associate-ids").value = checks;
    }
    else
    {
      document.getElementById("associate-ids").value = idvalue + ',' + checks;
    }
      value = $(this).val();
      document.getElementById('pagenumber').value = 1;
      $.ajax({
            type: 'GET',
              url: '<?php echo route('searchAssociate'); ?>',
              data: {search_user:value,selectedAssociate:idvalue,pagenumber:1,limit:6},
              dataType: 'json',
          })
        .done(function(response) {
            if(response != '')
            {
              $('#no_any_user').hide();
              $('#associatetable').show();
              $('#div-button').show();
              $('#usertable').html('');
              $('#usertable').append(response);
            }
            else
            {
              $('#div-button').hide();
               $('#associatetable').hide();
               $('#no_any_user').show();
            }
        });
    });
  /* $('input[name="associateid[]"]').click(function(){
      var value = $(this).val();
       if($(this).prop("checked") == true){
                alert(value);
            }
            else if($(this).prop("checked") == false){
                alert(value);
            }
     
    });
*/

      $("#associatetable").scroll(function() {

        var value = $('#search-user').val();
        var pagenumber1 = document.getElementById('pagenumber').value;
        var idvalue = document.getElementById("associate-ids").value;
        var pagenumber = ++pagenumber1;
        document.getElementById('pagenumber').value = pagenumber;
        $.ajax({
              type: 'GET',
              url: '<?php echo route('searchAssociate'); ?>',
              data: {search_user:value,selectedAssociate:idvalue,pagenumber:pagenumber,limit:6},
              dataType: 'json',
          success: function(response) {
          if(response === '')
          {
            //$pagenumber = --pagenumber1;
          }
          else
          {
            $('#usertable').append(response);
            pagenumber = pagenumber;
          }
           
        }
      });
    });
</script>
 <script type="text/javascript">
    $("#projectbid").keypress(function (e) {
      
      $('#projectbid').keyup(function(e) {
      if ($(this).val().indexOf('.') == 0 || $(this).val().indexOf('0') == 0) {
        $(this).val($(this).val().substring(1));
                  }
                });
                var regex = new RegExp("^[0-9\.\]+$");
                var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
                if(e.keyCode === 8 || e.keyCode === 46)  
                  return true;                
                if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
                  if(!regex.test(key)){
                    return false;      
                  }
                }
            });
    $("#budget_txt").keypress(function (e) {
      
      $('#budget_txt').keyup(function(e) {
      if ($(this).val().indexOf('.') == 0 || $(this).val().indexOf('0') == 0) {
        $(this).val($(this).val().substring(1));
                  }
                });
                var regex = new RegExp("^[0-9\.\]+$");
                var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
                if(e.keyCode === 8 || e.keyCode === 46)  
                  return true;                
                if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
                  if(!regex.test(key)){
                    return false;      
                  }
                }
            });
    $("#units_txt").keypress(function (e) {
      
      
                var regex = new RegExp("^[0-9\.\]+$");
                var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
                if(e.keyCode === 8 || e.keyCode === 46)  
                  return true;                
                if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
                  if(!regex.test(key)){
                    return false;      
                  }
                }
            });
    $("#footage_txt").keypress(function (e) {
      
      
                var regex = new RegExp("^[0-9\.\]+$");
                var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
                if(e.keyCode === 8 || e.keyCode === 46)  
                  return true;                
                if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
                  if(!regex.test(key)){
                    return false;      
                  }
                }
            });
    $("#building_txt").keypress(function (e) {
      
     
                var regex = new RegExp("^[0-9\.\]+$");
                var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
                if(e.keyCode === 8 || e.keyCode === 46)  
                  return true;                
                if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
                  if(!regex.test(key)){
                    return false;      
                  }
                }
            });
    $("#area_txt").keypress(function (e) {
      
     
                var regex = new RegExp("^[0-9\.\]+$");
                var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
                if(e.keyCode === 8 || e.keyCode === 46)  
                  return true;                
                if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
                  if(!regex.test(key)){
                    return false;      
                  }
                }
            });
    $("#stories_txt").keypress(function (e) {
      var regex = new RegExp("^[0-9\.\]+$");
      var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
      if(e.keyCode === 8 || e.keyCode === 46)  
                  return true;                
      if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
                  if(!regex.test(key)){
                    return false;      
                  }
                }
            });
    $("#built_txt").keypress(function (e) {
      var regex = new RegExp("^[0-9\.\]+$");
      var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
                if(e.keyCode === 8 || e.keyCode === 46)  
                  return true;                
                if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
                  if(!regex.test(key)){
                    return false;      
                  }
                }
            });
  </script>
  <script type="text/javascript">
          $(document).ready(function () {
          //called when key is pressed in textbox
            $("#instruction").focusout(function (e) {
               function firstToUpperCase( str ) {
                return str.substr(0, 1).toUpperCase() + str.substr(1);
              }
              var str = document.getElementById("instruction").value;
              var str = firstToUpperCase( str );  
              document.getElementById("instruction").value = str;
           });
          });
        </script>
</body>
</html>
                    
