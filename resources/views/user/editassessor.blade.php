
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> {{config('app.name')}} </title>
 <!--  <link href="{{asset('/css/themeCss/map.css')}}" rel="stylesheet"> -->
  <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">
  @include('layouts.include_css')
    <link href="{{asset('/css/frontCss/agency.css')}}" rel="stylesheet">
    <!-- <script src="{{asset('/js/themeJs/notification.js')}}"></script> -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link href="{{asset('/css/themeCss/map.css')}}" rel="stylesheet">
    <script src="{{asset('/js/themeJs/jquery-1.10.2.js')}}"></script>
    <script src="{{asset('/js/themeJs/bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/themeJs/bootstrap-select.min.js')}}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
 
  <!-- <link href="{{asset('/css/jquery.multiselect.css')}}" rel="stylesheet"/> -->
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
                    <b>Update Assessors & Employees</b>
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
                          <form class="new-project" id="editassessordetail" action="{{ route('updateAssesors') }}" method="PUT">
                              {{csrf_field()}}
                              <div class="row">
                                <input type="hidden" name="assesor_id" id="assesor_id" value="{{$userDetails->users_id}}">
                                <div class="form-group col-md-2"><br><label class="required">First Name</label></div>
                                   
                                <div class="form-group col-md-3 {{ $errors->has('users_name') ? ' has-error' : '' }}">
                                  <input type="text" id="users_name" name="users_name" value="{{ $userDetails->users_name }}" placeholder="First Name" required="">
                                 
                                </div>
                                <div class="form-group col-md-2">
                                  <br>
                                  <label class="required">Last Name</label>
                                </div>
                                <div class="form-group col-md-5 {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                  <input type="text" name="last_name" id="last_name" value="{{ $userDetails->last_name }}" placeholder="Last Name" autocomplete="off">
                                </div>  
                              </div>
                              <div class="row">
                                <div class="form-group col-md-2"><br><label class="required">Company Name</label></div>
                                   
                                <div class="form-group col-md-3 {{ $errors->has('users_company') ? ' has-error' : '' }}">
                                  <input type="text" name="users_company" value="{{ $userDetails->users_company }}" placeholder="Company Name" required="">
                                </div>
                                <div class="form-group col-md-2">
                                  <br>
                                  <label class="required">Email</label>
                                </div>
                                <div class="form-group col-md-5 {{ $errors->has('users_email') ? ' has-error' : '' }}">
                                  <input type="text" name="users_email" id="users_email" value="{{ $userDetails->users_email }}" placeholder="Email" autocomplete="off">
                                  <label id="users_email-error" class="error" for="users_email"></label>
                                </div>  
                              </div>
                              <div class="row">
                                <div class="form-group col-md-2"><br><label class="required">Phone Number</label></div>
                                   
                                  <div class="form-group col-md-3 {{ $errors->has('users_phone') ? ' has-error' : '' }}">
                                    <input type="text" name="users_phone" id="users_phone" value="{{ $userDetails->users_phone }}" placeholder="Phone Number" required="">
                                    
                                  </div>
                              </div>
                              <div class="row">
                              <div class="form-group col-md-2">
                                  <br>
                                  <label class="required">Address</label>
                                </div>
                                <div class="form-group col-md-8">
                                  <input type="text" name="address" id="address" value="{{ $userDetails->users_address }}" placeholder="site Address" required="" autocomplete="off">
                                  <input type="hidden" id="latitude" name="latitude" value="{{ $userDetails->latitude }}">
                                  <input type="hidden" id="longitude" name="longitude" value="{{ $userDetails->longitude }}">
                                </div>
                                <div class="form-group col-md-2">
                                  <br>
                                  <li style="color: #DA4453;" data-toggle="modal" data-target="#myModal"><a href="#">set address</a></li>
                                    @include('user.useraddressmap')
   
                                </div>
                          </div>
                          <div class="row">
                          <br>
                           <div class="form-group col-md-2">
                                <br><br><br>
                                <label class="required">Scope(s)</label>
                              </div>
                              <?php
                                $temp = explode(",", $userScopeid);
                              ?>
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
                              <!-- <div id="err"></div> -->
                          </div>
                        <div class="row">
                          <div class="form-group col-md-4">
                            </div>
                              <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-success" id="updateassessor"> Update   
                                </button>
                                </div>
                                <div class="form-group col-md-3">
                                <button type="button" class="btn btn-danger" id="cancel-update"> Cancel   
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
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBN9cqCkPR1yT6dmHjWFGgc_Fov0kThdwo&libraries=places&callback=initMap"
        async defer></script>  
  <script src="{{asset('/js/themeJs/map.js')}}"></script>
  <script src="{{asset('/js/themeJs/1_12_1_jquery.js')}}"></script>
  <script src="{{asset('js/frontJs/jquery.validate.js')}}"></script>  
    
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
    document.getElementById("editassessordetail").onkeypress = function(e) {
      var key = e.charCode || e.keyCode || 0;     
      if (key == 13) {
        e.preventDefault();
        return false;
      }
    }


    $(document).ready(function () {

      $('body').on('click','#updateassessor', function (event) {
      event.preventDefault(); 
    /*var date = new Date();
    var todaydate= (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear();
  */
    $("#editassessordetail").validate({
          rules: {
            users_name: {
                required: true,
            },last_name: {
                required: true,
            },users_company: { 
              required: true,
            },users_email: { 
                required: true,
                email:true,
                
            },address:{
                required: true,
               
            },
            "scopeperformedid[]": "required"
        },messages:{
            users_name: "Please Enter First Name",
            last_name: "Please Enter Last Name",
            users_company: "Please Enter Company Name",
            users_phone:{
              required : "Please Enter Phone Number",
            },
            users_email:{
              required : "Please Enter Email Address",
              email : "Please Enter Valid Email Address",
            },
            address:"Please Enter Address",
            "scopeperformedid[]": "Please select scope(s)"
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }

  });
    if($("#editassessordetail").valid()) {
   
        
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
              url: $("#editassessordetail").attr("action"),
              data: $('form#editassessordetail').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
          $(".loader").fadeOut("slow");
          if(msg.status == '1')
          {
            alert("Profile Updated Successfully");
            url = '<?php echo url('/users'); ?>';
            window.location.replace(url);
          }
          else
          {
            $("#users_email-error").text(msg.message).show().fadeIn("slow");
          }
        });
      }

    });
  })
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

    
</script>
 
</body>
</html>
                    
