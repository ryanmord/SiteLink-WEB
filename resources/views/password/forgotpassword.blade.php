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
    <title>Scoped</title>
     <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">
    <meta name="csrf-param" content="_csrf-frontend">
    <meta name="csrf-token" content="fkMSpKSo6hiL4aMtehZ6vsKrITZzXRMTNqJcc08Vjbn4x2CqKYTaK9bADjir9ZlwWVCoNVE0zG0Bn_VUB-ywPA==">
    <title></title>
 <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">

    @include('frontlayouts.include_css')
  <style type="text/css">
    #new_password-error
    {
      color: #b70a0a;
      float: left;
    }
    #confirm_password-error
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
            <a class="navbar-brand js-scroll-trigger" href="#"><img src="{{asset('img/front/logo.png')}}"></a>
           

            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          MENU          <i class="fa fa-bars"></i>
        </button>
            
        </div>
    </nav>

    <!-- Header -->
    <header class="masthead login">
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
                @if($flag == 0)
                    <div class="col-md-7 login-left">
                        <h2 class="left-title">We're here for you every step of the way.</h2>
                        <p>It all starts with you</p>
                    </div>

                    <div class="col-md-4 login-right">

                        <h4 class="h4 txtchng">Reset Password</h4>
                        <form id="resetpassword-form" method="POST" action="{{ url('/changepassword') }}" role="form">
                         {{ csrf_field() }}
                            <div class="form-group">
                                <div class="form-group field-loginform2-password">
                                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required="">
                                   <input type="hidden" id="userid" name="userid" 
                                   value= {{ $userid }}>
                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group field-loginform2-password">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required="">
                                   
                                </div>
                              <label id="errormsg" class="error" style="color: #b70a0a;"></label>
                            </div>
                            
                            <div class="form-group">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="changepwd">Change Password
                                    </button>
                                </div>
                            </div>
                           
                        </form>
                        
                    </div>
                    @else
                    <div class="col-md-7 login-left">
                        <h2 class="left-title">You have already reset the password.</h2>
                       
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </header>
    <!-- Footer -->
    @include('frontlayouts.footer')
    @include('frontlayouts.include_js')

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js">
    </script>
  <script>

$(document).ready(function () {
   $(".loader").fadeOut("slow");
            $('body').on('click','#changepwd', function (event) {
            event.preventDefault(); 
            
          $('#resetpassword-form').validate({
          // initialize the plugin

          rules: {
            new_password: 
            {
              required: true,
              minlength:6
            },
            confirm_password: 
            {
              required: true,
              minlength:6
            }
            
            
            
        }
       
    });
    if($("#resetpassword-form").valid()) {
      $(".loader").fadeIn("slow");
       
      $.ajax({
            type: 'POST',
              url: $("#resetpassword-form").attr("action"),
              data: $('form#resetpassword-form').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
             $(".loader").fadeOut("slow");
          if(msg.success)
          {
              alert(msg.success);
              $(".loader").fadeOut("slow");
                 window.location.reload();
          }
         
          if(msg.error)
          {
            $("#errormsg").html(msg.error).show();
          }

          
        });

        
      }

    });
   
  });
   
  </script>

   
</body>

</html>