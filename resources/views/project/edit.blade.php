
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title> Scoped </title>
   <link href="{{asset('/css/themeCss/map.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    @include('layouts.include_css')
    <link href="{{asset('/css/frontCss/agency.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>
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
 
  </head>

<!-- Body -->
  <body>
    <div class="preloader-it">
      <div class="la-anim-1"></div>
    </div>
    <div class="wrapper theme-6-active pimary-color-pink">

      <!-- Top Menu Items -->
      @include('layouts.main_topheader')
      <!-- /Top Menu Items -->
      <!-- Left Sidebar Menu -->
      @include('layouts.main_sidebar')
      <!-- /Left Sidebar Menu -->
      <!-- Main Content -->
      <div class="loader" style="position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{ asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;">
      </div>
      <div class="page-wrapper">
        <div class="container-fluid pt-20">
          <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-success" style="text-align: left;">
              <div class="panel-heading">
                <div class="panel-title"><b>Update Project</b>
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
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <form class="new-project" id="editproject" action="{{ url('updateProject/'.$project->project_id) }}">
                      {{csrf_field()}}
                      <div class="row">
                        <div class="form-group col-md-3">
                          <br>
                          <label class="required">Project Name</label>
                        </div>
                        <div class="form-group col-md-9">
                          <input type="text" name="projectname" value="{{ $project->project_name }}" placeholder="Project Name" required="">
                        </div>
                      </div>
                      <div class="row">
                      
                        <div class="form-group col-md-3">
                          <br>
                          <label class="required">Site Address</label>
                        </div>
                        <div class="form-group col-md-7 {{ $errors->has('address') ? ' has-error' : '' }}">
                                    
                          <input type="text" name="siteaddress" readonly="" id="address" value="{{ $project->project_site_address }}" placeholder="site Address" data-toggle="modal" data-target="#myModal" required="">
                          <input type="hidden" id="latitude" name="latitude" value="{{ $project->latitude }}">
                          <input type="hidden" id="longitude" name="longitude" value="{{ $project->longitude }}">
                        </div>
                        <div class="form-group col-md-2">
                          <br>
                          <li style="color: #DA4453" data-toggle="modal" data-target="#myModal"><a href="#">set address</a></li>
                          @include('project.demomap')
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <br><br>
                          <label class="required">Miles Range</label>
                        </div>
                        <div class="form-group col-md-9 {{ $errors->has('miles') ? ' has-error' : '' }}">
                          <output style="float: left;">Radius&nbsp</output>
                          <output name="miles" id="miles" style="float: left;">
                          {{ $project->milesrange }}</output>
                          <output style="float: left;">&nbspMILES</output>
                          <input type="range" name="milesrange" id="milesrange" value="{{ $project->milesrange }}" min="{{ $minvalue }}" max="{{ $maxvalue }}" oninput="miles.value = milesrange.value">
                          <output name="minmiles" id="minmiles" style="float: left;">{{$minvalue }} MILES</output>
                          <output name="maxmiles" id="maxmiles" style="float: right;">{{$maxvalue }} MILES</output>
                          <br>
                          <br>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <br>
                          <label class="required">Report Due From Field</label>
                        </div>
                        <div class="form-group col-md-4 {{ $errors->has('reportdate') ? ' has-error' : '' }}">
                          <input type="text" name="reportdate" id="reportdate" value="{{ $reportdate }}" placeholder="Report Due Date" autocomplete="off">
                          <i class="fa fa-calendar" aria-hidden="true"></i>
                        </div>
                        <div class="form-group col-md-2">
                          <br>
                          <label>On Site Date</label>
                        </div>
                        <div class="form-group col-md-3">
                          <input type="text" name="onsitedate" id="onsitedate" value="{{ $onsitedate }}" placeholder="On Site Date" autocomplete="off">
                          <i class="fa fa-calendar" id="datepickericon"></i>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <br>
                          <label class="required">Report Template</label>
                        </div>
                        <div class="form-group col-md-9">
                          <input type="text" name="template" value="{{ $project->report_template }}" placeholder="Report template" required="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <br>
                          <label>Special Instructions</label>
                        </div>
                        <div class="form-group col-md-9">
                          <input type="text" name="instruction" value="{{ $project->instructions }}" placeholder="Special instruction">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-3"  field-customers-first_name>
                          <br>
                          <label class="required">Project Type</label>
                        </div>
                        <div class="form-group col-md-9">
                          <input type="text" name="projectType" id="projectType" placeholder="Project Type" id="projectType" value="{{ $project->property_type}}">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <br>
                          <label class="required">No. Units</label>
                        </div>
                        <div class="form-group col-md-3">
                          <input type="text" name="units_txt" id="units_txt" value="{{ $project->no_of_units }}"  placeholder="  No.of units" required="" style="padding-left: 12px;">
                        </div>
                        <div class="form-group col-md-3">
                          <br>
                          <label class="required">Sq. Footage</label>
                        </div>
                        <?php 
                          $squareFootage = number_format($project->squareFootage, 2);
                        ?>
                        <div class="form-group col-md-3">
                          <input type="text" name="footage_txt" id="footage_txt" placeholder="  Sq. Footage" value="{{ $squareFootage }}" required="" style="padding-left: 12px;">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <br> 
                            <label class="required">No. Buildings</label>
                              </div>
                              <div class="form-group col-md-3">
                                <input type="text" name="building_txt" id="building_txt"  placeholder="  No.Buildings" required="" value="{{ $project->no_of_buildings }}" style="padding-left: 12px;">
                              </div>
                              <div class="form-group col-md-3">
                                <br>
                                <label class="required">Land Area</label>
                              </div>
                              <div class="form-group col-md-3">
                                <input type="text" name="area_txt" id="area_txt"placeholder="  Land Area" required="" value="{{ $project->land_area }}" style="padding-left: 12px;">
                              </div>
                            </div>
                              <div class="row">
                                <div class="form-group col-md-3">
                                  <br>
                                  <label class="required">No. Stories</label>
                                </div>
                                <div class="form-group col-md-3">
                                <input type="text" name="stories_txt" id="stories_txt"  placeholder="  No. Stories" value="{{ $project->no_of_stories }}" required="" style="padding-left: 12px;">
                              </div>
                               <div class="form-group col-md-3">
                                <br>
                                <label class="required">Year Built</label>
                              </div>
                              <div class="form-group col-md-3">
                                <input type="text" name="built_txt" id="built_txt" placeholder="  Year Built" value="{{ $project->year_built }}" required="" style="padding-left: 12px;" maxlength="4">
                              </div>
                            </div> 
                            <div class="row">
                              <div class="form-group col-md-3">
                                <br>
                                <label class="required">Budget</label>
                              </div>
                              <div class="form-group col-md-3">
                               <?php 
                              $budget = number_format($project->budget, 2);
                              ?>
                                <input type="text" name="budget_txt" id="budget_txt" placeholder="  Budget" value="{{ $budget }}" required="" style="padding-left: 12px;">
                                <i class="glyphicon glyphicon-usd form-control-feedback" style="left: 0; line-height: 27px;"></i>
                              </div>
                               <div class="form-group col-md-3">
                                <br>
                                <label class="required">Suggest A Bid</label>
                              </div>
                              <div class="form-group col-md-3">
                               <?php 
                              $approx_bid = number_format($project->approx_bid, 2);
                              ?>
                                <input type="text" name="projectbid" id="projectbid" placeholder="  Suggest a bid" value="{{ $approx_bid }}" required="" style="padding-left: 12px;">
                                <i class="glyphicon glyphicon-usd form-control-feedback" style="left: 0; line-height: 27px;"></i>
                          </div>
                        </div>
                    
                      <?php
                        $temp = explode(",", $project['scope_performed_id']);
                      ?>
                    <div class="row">
                      <div class="form-group col-md-3">
                        <br><br><br>
                        <label class="required">Scope(s)</label>
                      </div>
                      <div class="form-group col-md-9">
                        @foreach($scope as $value)
                          @if(in_array("$value->scope_performed_id", $temp))
                            <label class="checkbox" style="color: grey;">
                              <input type="checkbox" value="{{ $value->scope_performed_id }}" name="scopeperformedid[]" id="scope_performed" checked>
                              {{ $value->scope_performed }} 
                            </label>
                          @else 
                            <label class="checkbox" style="color: grey;">
                              <input type="checkbox" value="{{ $value->scope_performed_id }}" name="scopeperformedid[]" id="scope_performed">
                              {{ $value->scope_performed }} 
                            </label>
                          @endif
                        @endforeach
                        <label id="scopeperformedid[]-error" class="error" for="scopeperformedid[]" style="color: #b70a0a;"></label>
                        <!-- <input type="hidden" id="scopeid" name="scopeid" value=""> -->
                      </div>
                    </div>
                    <?php
                        $temp = explode(",", $project['employee_type_id']);
                      ?>
                    <div class="row">
                      <div class="form-group col-md-3">
                        <br>
                          <label class="required">Employee Type</label>
                            </div>
                              <!-- select associate type -->
                              <div class="form-group col-md-9">
                                @foreach($associatetype as $value)
                                @if(in_array("$value->associate_type_id", $temp))
                                  <label class="checkbox" style="color: grey;">
                                    <input type="checkbox" value="{{ $value->associate_type_id }}" name="associatetypeid[]" id="associatetypeid[]" checked>
                                    {{ $value->associate_type }} 
                                  </label>
                                  @else
                                    <label class="checkbox" style="color: grey;">
                                    <input type="checkbox" value="{{ $value->associate_type_id }}" name="associatetypeid[]" id="associatetypeid[]">
                                    {{ $value->associate_type }} 
                                  </label>
                                  @endif
                                @endforeach
                                 <label id="associatetypeid[]-error" class="error" for="associatetypeid[]" style="color: #b70a0a;"></label>
                             
                              </div>
                              <!-- <div id="err"></div> -->
                              </div>
                              <div class="row">
                              <div class="form-group col-md-3">
                                
                                <label id="selectIdLabel">Select Individual(s)</label>
                              </div>
                              <!-- select associate type -->
                              <div class="form-group col-md-9">
                               <a href="#associate-list" data-toggle="modal"><u style="color: #fe5f55;" id="add-individuals">+ Add Individual(s)</u>
                               </a>
                              </div>
                              @include('project.asscociatelist')
                              <!-- <div id="err"></div> -->
                              </div>
                              <div class="row" id="userName-div">
                                <div class="form-group col-md-3">
                                  <!-- <label id="selectIdLabel">Selected Individual(s)</label> -->
                                </div>
                                <!-- select associate type -->
                                <div class="form-group col-md-9">
                                <div class="table-responsive" style="max-height: 100px;overflow: auto;">
                                 <table class="table table-bordered table-hover table-striped">
                                    <tbody id="associateNames">
                                   

                                    </tbody></table></div>
                                </div>
                              </div>
                            <div class="row">
                              <div class="form-group col-md-5">
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
        </header>
      </div>
    </div>
  </div>
</div>
</div>
</div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFesVLN0rhPhI0uHrMrQjclKdbyx9X9g0&libraries=places&callback=initMap"
        async defer></script>  
  <script src="{{asset('/js/themeJs/map.js')}}"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/caret/1.0.0/jquery.caret.min.js">
    
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
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js">
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
               
            },selectmanger:{
                required: true,
               
            },projectbid:{
              required: true,
            },
            building_txt:{
              required: true,
              min:1
            },
            built_txt:{
              required: true,
              min:4
            },
            units_txt:{
              required: true,
              min:1
            },
            stories_txt:{
              required: true,
              min:1
            },
            area_txt:{
              required: true,
              min:1
            },
            footage_txt:{
              required: true,
              min:1
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
            projectType:"Please Enter Project Type",
            built_txt:"Please Enter Year Built",
            building_txt:"Please Enter No.of Buildings",
            stories_txt:"Please Enter No. of Stories",
            footage_txt:"Please Enter No. of Footage",
            area_txt:"Please Enter Land Area",
            budget_txt:"Please Enter Budget",
            units_txt:"Please Enter No. of Units",
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
  </body>
</html>
                    
