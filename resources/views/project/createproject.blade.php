
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <title> Scoped </title>
    <!-- <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.8/firebase-messaging.js"></script>
 -->
    <link href="{{asset('/css/themeCss/map.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    @include('layouts.include_css')
    <link href="{{asset('/css/frontCss/agency.css')}}" rel="stylesheet">
    <!-- <script src="{{asset('/js/themeJs/notification.js')}}"></script> -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
 
  <!-- <link href="{{asset('/css/jquery.multiselect.css')}}" rel="stylesheet"/> -->
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
        <!-- Left Sidebar Menu -->
        @include('layouts.main_sidebar')
        <!-- Main Content -->
        <div class="loader" style="position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{ asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;"></div>
          <div class="page-wrapper">
            <div class="container-fluid pt-20">
              <div class="col-xs-12 col-sm-9 content">
                <div class="panel panel-success" style="text-align: left;">
                  <div class="panel-heading">
                    <div class="panel-title"><b>Create New Project</b>
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
           
                            <form class="new-project" id="createproject" action="{{ url('/saveproject') }}">
                              {{csrf_field()}}
                              <div class="row">
                                <div class="form-group col-md-3">
                                  <br>
                                  <label>Project Name</label>
                                </div>
                                <div class="form-group col-md-9">
                                  <input type="text" name="projectname" value="" placeholder="Project Name" required="">
                           
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-3">
                                  <br>
                                  <label>Site Address</label>
                                </div>
                                <div class="form-group col-md-7">
                                  <input type="text" name="siteaddress" readonly="" id="address" value="" placeholder="site Address" data-toggle="modal" data-target="#myModal" required="">
                                  <input type="hidden" id="latitude" name="latitude" value="">
                                  <input type="hidden" id="longitude" name="longitude" value="">
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
                                <label>Miles Range</label>
                              </div>
                              <div class="form-group col-md-9 {{ $errors->has('miles') ? ' has-error' : '' }}">
                                <output style="float: left;">Radius&nbsp</output>
                                <output name="miles" id="miles" style="float: left;">{{$minvalue }}</output>
                                <output style="float: left;">&nbspMILES</output>
                                <input type="range" name="milesrange" id="milesrange" value="{{ $minvalue }}" min="{{ $minvalue }}" max="{{ $maxvalue }}" oninput="miles.value = milesrange.value">
										            <output name="minmiles" id="minmiles" style="float: left;">{{$minvalue }} MILES</output>
    									          <output name="maxmiles" id="maxmiles" style="float: right;">{{$maxvalue }} MILES</output>
    									          <br>
    									          <br>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-3">
                                <br>
                                <label>Report Due From Field</label>
                              </div>
                              <div class="form-group col-md-4 {{ $errors->has('reportdate') ? ' has-error' : '' }}">
                                <input type="text" name="reportdate" id="reportdate" value="" placeholder="Report Due Date">
                                <i class="fa fa-calendar" aria-hidden="true">
                                </i>
                              </div>
                              <div class="form-group col-md-2">
                                <br>
                                <label>On Site Date</label>
                              </div>
                              <div class="form-group col-md-3">
                                <input type="text" name="onsitedate" id="onsitedate" value="" placeholder="On Site Date">
                                <i class="fa fa-calendar" id="datepickericon"></i>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-3">
                                <br>
                                <label>Report Template</label>
                              </div>
                              <div class="form-group col-md-9">
                                <input type="text" name="template" value="" placeholder="Report template" required="">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-3"  field-customers-first_name>
                                <br>
                                <label>Special Instructions</label>
                              </div>
                              <div class="form-group col-md-9">
                                <input type="text" name="instruction" value="" placeholder="Special instruction" id="instruction">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-3">
                                <br>
                                <label>Suggest A Bid</label>
                              </div>
                              <div class="form-group col-md-9">
                                <input type="text" name="projectbid" id="projectbid" value="" placeholder="  Suggest a bid" required="" style="padding-left: 12px;">
                                <i class="glyphicon glyphicon-usd form-control-feedback" style="left: 0; line-height: 27px;"></i>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-3">
                                <br><br><br>
                                <label>Scope Performed</label>
                              </div>
                              <div class="form-group col-md-9">
                                @foreach($scope as $value)
                                  <label class="checkbox" style="color: grey;">
                                    <input type="checkbox" value="{{ $value->scope_performed_id }}" name="scopeperformedid[]" id="scopeperformedid[]">
                                    {{ $value->scope_performed }} 
                                  </label>
                                @endforeach
                                <label id="scopeperformedid[]-error" class="error" for="scopeperformedid[]" style="color: #b70a0a;"></label>
                                <input type="hidden" id="scopeid" name="scopeid" value="">
                             
                              </div>
                              <div id="err"></div>
                              </div>

                              <div class="row">
                                <div class="form-group col-md-3">
                                  <br><br><br>
                                  <label>Project Manager</label>
                                </div>
                                <div class="form-group col-md-9">
                                  <select class="form-control selectpicker" data-live-search="true" id="selectmanger" name="selectmanger" style="width:100px;max-height:50px;overflow-y:auto;">
                                    <option value="">--Select Project Manager--</option>
                                    @foreach($user as $value)

                                      <option value="{{ $value->users_id }}">
                                      {{ $value->users_name }}</option>

                                    @endforeach
                                  </select> 

                                  <input type="hidden" id="managerid" name="managerid" value="">
                                </div>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-3">
                                </div>
                                <div class="form-group col-md-3">
                                  <button type="submit" class="btn btn-success" id="saveproject"> Submit   
                                  </button>
                                </div>
                                <div class="form-group col-md-3">
                                  <button type="reset" class="btn btn-danger" id="reset"> Reset  
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/caret/1.0.0/jquery.caret.min.js"></script>
        <script type="text/javascript">
          $(window).load(function() {
            $(".loader").fadeOut("slow");
          });
        </script>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#selectmanger").change(function(){
                var managerid = jQuery("#selectmanger option:selected").val();
                document.getElementById("managerid").value = managerid;
            });
          });
        </script>
        
          <script type="text/javascript">
          $(document).ready(function () {
          //called when key is pressed in textbox
            $("#instruction").keyup(function (e) {
               function firstToUpperCase( str ) {
                return str.substr(0, 1).toUpperCase() + str.substr(1);
              }
              var str = document.getElementById("instruction").value;
              var str = firstToUpperCase( str );  
              document.getElementById("instruction").value = str;
           });
          });
        </script>
        <script type="text/javascript">
          $(document).ready(function () {
          //called when key is pressed in textbox
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
          });
        </script>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js">
  
        </script>
        <script>
          document.getElementById("createproject").onkeypress = function(e) {
            var key = e.charCode || e.keyCode || 0;     
              if (key == 13) {
                e.preventDefault();
                return false;
              }
            }
            $(document).ready(function() {
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
            
          $('#createproject').validate({
          // initialize the plugin

          rules: {
            projectname: 
            {
              required: true
            },
            siteaddress: 
            {
              required: true
            },
            managerid: 
            {
              required: true,
            },
            reportdate: 
            {
              required: true,
            },
            template: 
            {
              required: true,
            },
            selectmanger: 
            {
              required: true,
            },
            
            projectbid: 
            {
              required: true,
              number: true,
              min:1
            },
            'scopeperformedid[]': 
            {
              required: true, 
              minlength: 1 
            },
            
        }
       
    });
    if($("#createproject").valid()) {
        checks = $('input[type="checkbox"]:checked').map(function(){
              return $(this).val();
                }).get();
        document.getElementById("scopeid").value = checks;
        $(".loader").fadeIn("slow");
        $.ajax({
            type: 'POST',
              url: $("#createproject").attr("action"),
              data: $('form#createproject').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
          $(".loader").fadeOut("slow");
          alert("Project created successfully");
          url = '<?php echo route('allProjects'); ?>';
          window.location.replace(url);
          
        });
      }

    });
  });
  </script>
 
 </body>
 </html>
                    
