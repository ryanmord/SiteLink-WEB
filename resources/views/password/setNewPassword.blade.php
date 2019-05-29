<?php
    $currentroutename = Route::currentRouteName();
    $action = Route::currentRouteAction();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="{{secure_asset('img/front/fav-logo.png')}}" type="image/png" sizes="16x16">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{config('app.name')}}</title>
     <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">
    <meta name="csrf-param" content="_csrf-frontend">
    <meta name="csrf-token" content="fkMSpKSo6hiL4aMtehZ6vsKrITZzXRMTNqJcc08Vjbn4x2CqKYTaK9bADjir9ZlwWVCoNVE0zG0Bn_VUB-ywPA==">
    <title></title>
 <link rel="shortcut icon" href="{{{ secure_asset('img/brick-wall.png') }}}">

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
    #useremail-error
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
            <a class="navbar-brand js-scroll-trigger" href="#"><img src="{{secure_asset('img/front/logo.png')}}"></a>
           

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
        background: url('{{ secure_asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;"></div>
            <div class="intro-text">
                <div class="pdding-left">
            
                    <div class="col-md-7 login-left">
                        <h2 class="left-title">We're here for you every step of the way.</h2>
                        <p>It all starts with you</p>
                    </div>

                    <div class="col-md-4 login-right">
                      <h4 class="h4 txtchng">Set Password</h4>
                        <form id="resetpassword-form" method="POST" action="{{ url('/updateNewPassword') }}" role="form">
                         {{ csrf_field() }}
                            <div class="form-group">
                                <div class="form-group field-loginform2-password">
                                  <input type="email" name="useremail" id="useremail" class="form-control" placeholder="Email Address" required="">
                                   <label id="useremail-error" name="useremail-error" class="error"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group field-loginform2-password">
                                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required="">
                                   <input type="hidden" id="userid" name="userid" 
                                   value="{{ $userid }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group field-loginform2-password">
                                  <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required="">
                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="changepwd">Set Password
                                    </button>
                                </div>
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

   
  <script>

$(document).ready(function () {
   $(".loader").fadeOut("slow");
            $('body').on('click','#changepwd', function (event) {
            event.preventDefault(); 
          $("#resetpassword-form").validate({
        rules: {
            new_password: 
            {
              required: true,
              minlength:6
            },
            confirm_password: 
            {
              required: true,
              minlength:6,
              equalTo :"#new_password"
            },
            useremail: {
                required: true,
                email:true,
            },
          },messages:{
            useremail: {
                required: "Please Enter Email Address",
                minlength:"Please Enter valid email Address"
            },
             new_password: {
                required: "Please Enter New Password",
                minlength:"Please enter at least 6 characters."
            },
             confirm_password: {
                required: "Please Enter Confirm Password",
                minlength:"Please enter at least 6 characters.",
                equalTo :"Please Enter the same password as above"
            },
          },errorPlacement: function(error, element) {
            error.insertAfter(element);
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
                url = '<?php echo route('cmslogin'); ?>';
                window.location.replace(url);
          }
          if(msg.error)
          {
            $("#useremail-error").html(msg.error).show();
          }
        });
      }

    });
   
  });
   
  </script>

   
</body>

</html>