<?php
    $currentroutename = Route::currentRouteName();
    $action = Route::currentRouteAction();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="{{asset('img/front/fav-logo.png')}}" type="image/png" sizes="16x16">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{config('app.name')}}</title>
     <link href="{{asset('/css/frontCss/front_font.css')}}" rel="stylesheet" type="text/css">
    <meta name="csrf-param" content="_csrf-frontend">
    <meta name="csrf-token" content="fkMSpKSo6hiL4aMtehZ6vsKrITZzXRMTNqJcc08Vjbn4x2CqKYTaK9bADjir9ZlwWVCoNVE0zG0Bn_VUB-ywPA==">
    <title></title>

  <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">

    @include('frontlayouts.include_css')
  <style type="text/css">
    #admin_users_email-error
    {
      color: #b70a0a;
      float: left;
    }
    #femail-error
    {
      color: #b70a0a;
      float: left;
    }
    #admin_users_password-error
    {
      color: #b70a0a;
      float: left;
    }
  </style>
</head>
<body id="page-top">
  <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top " id="mainNav">
      <div class="container">
        <!-- #page-top -->
        <a class="navbar-brand js-scroll-trigger" href="{{ url('/')}}"><img src="{{asset('img/front/logo.png')}}"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          MENU          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{ url('/managerSignup')}}">Register
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link js-scroll-trigger" href="{{ url('/')}}">Login</a>
          </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead login sign-up">
      <div class="container">
        <div class="loader" style="position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{ asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;"></div>
        <div class="intro-text">
          <div class="pdding-left">
            <div class="col-md-7 login-left">
              <h2 class="left-title">We're here for you every step of the way.</h2>
              <p>It all starts with you</p>
            </div>
            <div class="col-md-4 plans-tab"> 
              <div class="col-md-4 login-right">
                <h4 class="h4 txtchng">Login here</h4>
                  <form id="login-form" method="POST" action="{{ url('/login') }}" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <div class="btn-group btn-group-vertical" data-toggle="buttons">
                        <label class="btn col-md-6">
                          <input type="radio" name='customertype' class='types' value='1' checked="">
                          <i class="fa fa-circle-o fa-2x"></i>
                          <i class="fa fa-dot-circle-o fa-2x"></i> 
                          <span>Login as Manager</span>
                        </label>
                        <label class="btn col-md-6">
                          <input type="radio" name='customertype' class='types' value='2'>
                          <i class="fa fa-circle-o fa-2x"></i>
                          <i class="fa fa-dot-circle-o fa-2x"></i>
                          <span> Login as Admin </span>
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-group field-loginform2-username">
                        <input type="text" name="admin_users_email" id="admin_users_email" class="form-control" name="email" placeholder="Email" required="">
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group field-loginform2-password">
                          <input type="password" name="admin_users_password" id="admin_users_password" class="form-control" name="" placeholder="Password" required="">
                        </div>
                      <label id="errormsg" class="error" style="color: #b70a0a;">
                      </label>
                    </div>
                    <div class="form-group">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="login">LOGIN
                        </button>
                      </div>
                    </div>
                  </form>
                  <form id="forgot_password" method="POST" action="{{ url('/userForgotPassword') }}" role="form">
                    {{ csrf_field() }}
                    <div class='forgotemail' style='display:none;'>
                      <input name='femail' type='email' id='femail' placeholder='Enter Your Email'><br><br>
                    <label id="pwderror" class="error" style="color: #b70a0a;float: left;">
                        
                      </label>
                      <button type="submit" class="btn btn-primary chkforgotpwd" name="login-button" id="forgot">SUBMIT</button>
                    </div>
                  </form>
                  <a href="#" style="color: black;float: left;" id="resend">Resend</a>
                  <a class="forgot-pass" href="javascript:void(0)">Forgot password?</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- Footer -->
      @include('frontlayouts.footer')
      @include('frontlayouts.include_js')

    
    </script>
    <script>
$(document).ready(function() {
  $('#resend').hide();
      
    });
$(document).ready(function () {
  $(".loader").fadeOut("slow");
            $('body').on('click','#login', function (event) {
            event.preventDefault(); 
            
          $('#login-form').validate({
          // initialize the plugin

          rules: {
            admin_users_email: 
            {
              required: true,
              email:true
            },
            admin_users_password: 
            {
              required: true
            },
        },messages:{
            admin_users_email: "Please Enter Email Id",
            admin_users_password: "Please Enter Password",
            
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
       
    });
    if($("#login-form").valid()) {
     $(".loader").fadeIn("slow");
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
      $.ajax({
            type: 'POST',
              url: $("#login-form").attr("action"),
              data: $('form#login-form').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
          $(".loader").fadeOut("slow");
          if(msg.usertype == 1)
          {
            url = '<?php echo route('dashboard'); ?>';
            window.location.replace(url);
          }
          if(msg.usertype == 2)
          {
            url = '<?php echo route('managerDashboard'); ?>';
            window.location.replace(url);
          }
          if(msg.error)
          {
            $("#errormsg").html(msg.error).show();
          }
          if(msg.emailStatus == '1')
          {
            $('#resend').show();
          }
        });

        
      }

    });
    $('body').on('click','#forgot', function (event) {
            event.preventDefault(); 
            
          $('#forgot_password').validate({
          // initialize the plugin
          rules: {
            femail: 
            {
              required: true,
              email:true
            }
        },messages:{
            femail: "Please Enter Email Id",
            
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });
    if($("#forgot_password").valid()) {
      $(".loader").fadeIn("slow");
      $.ajax({
            type: 'POST',
              url: $("#forgot_password").attr("action"),
              data: $('form#forgot_password').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
          $(".loader").fadeOut("slow");
          if(msg.success)
          {
              alert(msg.success);
              document.getElementById("femail").value = '';
              
          }
         
          if(msg.error)
          {
            $("#pwderror").html(msg.error).show();
          }
    

          
        });

        
      }

    });
  });
    $(document).ready(function() {
      
      var refreshId1 = setInterval(function() {
        $(".errormsg").remove();
        $(".errmsg").remove();
        $(".successmsg1").remove();
      }, 10000); 
      
      $('.forgotemail').hide();
      $('.forgot-pass').on('click', function(e) {        
         $('#login-form').toggle('show');
         $('.forgotemail').toggle('hide');
         var txt = $('.forgot-pass').text();
         if(txt == 'Forgot password?' || txt == '忘记密码？' ){
           
            var msg1 = 'Already registered? Login here';
            var msg2 = 'Forgot Password';
           
           $('.txtchng').text(msg2);
           $('.h3chng').text('');
           $('.forgot-pass').text(msg1);
         }else{
            var msg1 = 'Already registered';
            var msg2 = 'Login here';
            var msg3 = 'Forgot password?';
            $('.txtchng').text(msg2);
            $('.h3chng').text(msg2);
            $('.forgot-pass').text(msg3);
         }
         
      });
  });
     $('body').on('click','#resend', function (event) {
            event.preventDefault(); 
            
          $('#login-form').validate({
          // initialize the plugin

          rules: {
            
            admin_users_email:
            {
              required:true,
              email:true
            }
            
        }
       
    });
    if($("#login-form").valid()) {
      $(".loader").fadeIn("slow");
      login_email = document.getElementById("admin_users_email").value;
      var url = url = '<?php echo route('resendCode'); ?>';
      $.ajax({
            type: 'GET',
              url: url,
              data: {login_email:login_email},
              dataType: 'json',
          })

          .done(function(msg) {
          $(".loader").fadeOut("slow");
          if(msg.success)
          {
            alert(msg.success);
           
            
          }
          if(msg.error)
          {

            $("#errormsg").html(msg.error).show();
          }

          
        });

        
      }

    });
  </script>

   
</body>

</html>