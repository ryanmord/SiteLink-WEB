
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title> {{config('app.name')}} </title>
 <!--  <link href="{{secure_asset('/css/themeCss/map.css')}}" rel="stylesheet"> -->
  <link rel="shortcut icon" href="{{{ secure_asset('img/brick-wall.png') }}}">
  @include('layouts.include_css')
    <link href="{{secure_asset('/css/frontCss/agency.css')}}" rel="stylesheet">
    <!-- <script src="{{secure_asset('/js/themeJs/notification.js')}}"></script> -->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link href="{{secure_asset('/css/themeCss/map.css')}}" rel="stylesheet">
    <script src="{{secure_asset('/js/themeJs/jquery-1.10.2.js')}}"></script>
    <script src="{{secure_asset('/js/themeJs/bootstrap.min.js')}}"></script>
    <script src="{{secure_asset('/js/themeJs/bootstrap-select.min.js')}}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
 
  <!-- <link href="{{secure_asset('/css/jquery.multiselect.css')}}" rel="stylesheet"/> -->
 
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
    background: url('{{ secure_asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
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
                    <b>Update Project Manager</b>
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
                          <form class="new-project" id="editprojectmanager" action="{{ url('updateProjectManager/'.$userId) }}">
                              {{csrf_field()}}
                              <div class="row">
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
                                </div>  
                              </div>
                              <div class="row">
                                <div class="form-group col-md-2"><br><label class="required">Phone Number</label></div>
                                   
                                <div class="form-group col-md-3 {{ $errors->has('users_phone') ? ' has-error' : '' }}">
                                  <input type="text" name="users_phone" id="users_phone" value="{{ $userDetails->users_phone }}" placeholder="Phone Number" required="">
                                  
                                </div>
                              </div>
                          <div class="row">
                          <div class="form-group col-md-3">
                            </div>
                              <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-success" id="saveprojectmanager"> Update   
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
 
  <script src="{{secure_asset('/js/themeJs/map.js')}}"></script>
  <script src="{{secure_asset('/js/themeJs/1_12_1_jquery.js')}}"></script>
  <script src="{{secure_asset('js/frontJs/jquery.validate.js')}}"></script>  
    
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
    document.getElementById("editprojectmanager").onkeypress = function(e) {
      var key = e.charCode || e.keyCode || 0;     
      if (key == 13) {
        e.preventDefault();
        return false;
      }
    }


    $(document).ready(function () {

      $('body').on('click','#saveprojectmanager', function (event) {
      event.preventDefault(); 
    /*var date = new Date();
    var todaydate= (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear();
  */
  $.validator.addMethod("validateUserEmail", function(value, element)
  {
     
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')} });
      $.ajax(
      {
          type: "POST",
          url: '{{url("/checkProjectManagerEmail/$userId")}}',
          dataType: "html",
          async:false,
          data: {users_email:$('#users_email').val()},
          success: function(data)
          {
              console.log(data)
              //alert(data);return false;
              if ($.trim(data) == 'NOT_FOUND')
              {
                console.log("in not found");
                return true;
              }else if ($.trim(data) == 'FOUND')
              {console.log("in found");
                return false;
              }
          },
          error: function(xhr, textStatus, errorThrown)
          {
              return false;
          }
      });

  }, 'This email address is already registered.');
    $("#editprojectmanager").validate({
          onkeyup: false,
          onfocusout: false,
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
                remote: {
                  url: '{{url("/checkProjectManagerEmail/$userId")}}',
                  async:false,
                  dataType:"json",
                  type: "post",
                  dataFilter: function(response) {
                    response = $.parseJSON(response);

                    if (response.status === '0') return true;
                    else {
                        message = response.message;
                        return false;
                    }
                }
                }
            },users_phone:{
                required: true,
               
            }
        },messages:{
            users_name: "Please Enter First Name",
            last_name: "Please Enter Last Name",
            users_company: "Please Enter Company Name",
            users_phone:"Please Enter Phone",
            users_email:{
              required : "Please Enter Email",
              email :"Please enter valid email",
              remote: jQuery.validator.format("{0} is already in use")
            }
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }

  });
    if($("#editprojectmanager").valid()) {
   
        
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
            type: 'POST',
              url: $("#editprojectmanager").attr("action"),
              data: $('form#editprojectmanager').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
          $(".loader").fadeOut("slow");
          alert("Project Manager Profile Updated Successfully");
          url = '<?php echo url('/users'); ?>';
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

    
</script>
 
</body>
</html>
                    
