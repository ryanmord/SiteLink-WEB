@include('frontlayouts.main')
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
            <h4 class="h4 txtchng">Login here</h4>
            <form id="login-form" action="{{route('checkLogin')}}" method="post" role="form" name="login-form">
                {{ csrf_field() }}
                <div class="form-group">
                  <div class="form-group field-loginform2-username">
                    <input type="text" id="login_email" class="form-control" name="login_email"  placeholder="Email">
                    <div class="error">{{ $errors->first('login_email') }}</div>
                    </div>
                  </div>
                  <div class="form-group">
                  <div class="form-group field-loginform2-password">
                    <input type="password" id="login_password" class="form-control" name="login_password" placeholder="Password">
                      <div class="error">{{ $errors->first('login_password') }}
                      </div>
                      <label id="errmsg" class="error" style="color: #b70a0a;float: left;"></label>
                    </div>
                  </div>
							    <div class="form-group">
                    <button type="button" class="btn btn-primary" name="login_btn" id="login_btn">LOGIN</button>
                  </div>
                </form>
                <div class='forgotemail' style='display:none;'>
                  <input name='femail' type='email' id='femail'  placeholder='Enter Your Email'>
                  <div class="error">{{ $errors->first('femail') }}</div>
                  <label id="ferrmsg" class="error" style="color: #b70a0a; float: left;"></label><br>
                  <button type="button" class="btn btn-primary chkforgotpwd" name="forgot_password" id="forgot_password">SUBMIT</button>
                </div>
                <label id="resend" style="float: left;"><a href="#" style="color: black;">Resend</a></label>
						    <a class="forgot-pass" href="javascript:void(0)">Forgot password?</a>
              </div>
            </div>
          </div>
        </div>
	    </header>
    <!-- Footer -->
    @include('frontlayouts.footer')
    @include('frontlayouts.include_js')

	<script>
		$(document).ready(function() {
      $("#login-menu").removeClass('active');
      $("#userlogin-menu").addClass('active');
      $('#resend').hide();
			$(".loader").fadeOut("slow");
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
					 
					  var msg1 = 'Forgot password';
					  var msg2 = 'Already registered? Login here';
					 
					 $('.txtchng').text(msg1);
					 $('.h3chng').text(msg1);
					 $('.forgot-pass').text(msg2);
				 }else{
					  var msg1 = 'Login here';
					  var msg2 = 'Login here';
					  var msg3 = 'Forgot password?';
					  $('.txtchng').text(msg1);
					  $('.h3chng').text(msg2);
					  $('.forgot-pass').text(msg3);
				 }
				 
			});
			
			
		});
	
		 $('body').on('click','#login_btn', function (event) {
    		event.preventDefault(); 
  
    $("#login-form").validate({
    rules: {
            login_email: {
                required: true,
                email:true,
            },login_password: { 
              required: true,
            },
          },messages:{
            login_email: "Please Enter Email Id",
            login_password: "Please Enter Password",
            
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
      

  });
     if($("#login-form").valid()) {
      $(".loader").fadeIn("slow");
        $.ajax({
            type: 'POST',
              url: $("#login-form").attr("action"),
              data: $('form#login-form').serialize(),
              dataType: 'json',
          })

          .done(function(msg) {
            $(".loader").fadeOut("slow");
          	if(msg.status == '0' && msg.emailstatus == '1')
          	{
          		$("#errmsg").text(msg.message).show();
          	}
          	if(msg.emailstatus == '0')
          	{
                $("#errmsg").text('Please verify your email for email verification..').show();
                $('#resend').show();
          		  
          	}
          	if(msg.status == '1')
          	{
          		url = '<?php echo route('associateDashboard'); ?>';
          		window.location.replace(url);
          	}
        });

     }

  });
     
     $('#forgot_password').click(function(){
      var email = document.getElementById("femail").value;
      if(email == '')
      {
        $("#ferrmsg").text('Please Enter Email Address');
        $("#femail").focus();
        return false;
      }
      $(".loader").fadeIn("slow");
      $.ajax({
            type: 'GET',
              url: '<?php echo route('ForgotPassword'); ?>',
              data: {email:email},
              dataType: 'json',
          })

          .done(function(msg) {
            $(".loader").fadeOut("slow");
            if(msg.status == 1)
            {
              alert(msg.message);
              location.reload();
            }
            else
            {
              $("#ferrmsg").text(msg.message).show();
            }
        });
    }); 
     $('body').on('click','#resend', function (event) {
            event.preventDefault(); 
            
          $('#login-form').validate({
          // initialize the plugin

          rules: {
            
            login_email:
            {
              required:true,
              email:true
            }
            
        }
       
    });
    if($("#login-form").valid()) {
      $(".loader").fadeIn("slow");
      login_email = document.getElementById("login_email").value;
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