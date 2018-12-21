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
    #verification_code-error
    {
      color: #b70a0a;
      float: left;
    }
    #user_email-error
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
                    <div class="col-md-7 login-left">
                        <h2 class="left-title">We're here for you every step of the way.</h2>
                        <p>It all starts with you</p>
                    </div>

                    <div class="col-md-4 login-right">
                        <h4 class="h4 txtchng">Email Verification</h4>
                        <div>
                                <div>
                                  <p align="left" style="color: #212529;">A verification code has been sent to your email address.
                                  <br>
                                  Please enter the verification code into the verfication field.
                                  </p>
                                   
                        
                                </div>
                            </div>
                        <form id="verification-form" method="POST" action="{{ url('/checkVerifyCode') }}" role="form">
                         {{ csrf_field() }}
                             <div class="form-group">
                                <div class="form-group field-loginform2-email">
                                    <input type="text" name="user_email" id="user_email" class="form-control" placeholder="Email Address">
                                   
                              </div>
                              
                            </div>
                            <div class="form-group">
                                <div class="form-group field-loginform2-username">
                                    <input type="text" name="verification_code" id="verification_code" class="form-control" placeholder="Verification Code">
                                   
                              </div>
                              <label id="errormsg" class="error" style="color: #b70a0a;"></label>
                              <br>
                              <label id="resend" style="color: #ff6056;float: left;">Resend</label>
                            </div>
                            
                            
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="verify">Verify
                                    </button>
                               
                            </div>
                           
                        </form>

                       
                        
                    </div>
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
            $('body').on('click','#verify', function (event) {
            event.preventDefault(); 
            
          $('#verification-form').validate({
          // initialize the plugin

          rules: {
            verification_code: 
            {
              required: true,
              
            },
            user_email:
            {
              required:true,
              email:true
            }
            
        }
       
    });
    if($("#verification-form").valid()) {
      $(".loader").fadeIn("slow");
      $.ajax({
            type: 'POST',
              url: $("#verification-form").attr("action"),
              data: $('form#verification-form').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
          $(".loader").fadeOut("slow");
          if(msg.success)
          {
            alert(msg.success);
            if(msg.usertype == 2)
            {
                url = '<?php echo route('AssociateLogin'); ?>';
            }
            else
            {
              url = '<?php echo route('cmslogin'); ?>';
            }
            
            window.location.replace(url);
          }
          if(msg.error)
          {
            $("#errormsg").html(msg.error).show();
          }

          
        });

        
      }

    });
      $('body').on('click','#resend', function (event) {
            event.preventDefault(); 
            
          $('#verification-form').validate({
          // initialize the plugin

          rules: {
            
            user_email:
            {
              required:true,
              email:true
            }
            
        }
       
    });
    if($("#verification-form").valid()) {
      $(".loader").fadeIn("slow");
      var url = url = '<?php echo route('resendCode'); ?>';
      $.ajax({
            type: 'POST',
              url: url,
              data: $('form#verification-form').serialize(),
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
  });
   
  </script>

   
</body>

</html>