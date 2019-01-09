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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">

    @include('frontlayouts.include_css')
    <style type="text/css">
    #first_name-error
    {
      color: #b70a0a;
    }
    #customers_company-error
    {
      color: #b70a0a;
    }
    #customers_email-error
    {
      color: #b70a0a;
    }
    #customers_password-error
    {
      color: #b70a0a;
    }
    #confirm_password-error
    {
      color: #b70a0a;
    }
    #customers_phone-error
    {
      color: #b70a0a;
    }
    #legal-error
    {
      color: #b70a0a;
    }
    #lastname-error
    {
      color: #b70a0a;
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
                  <li class="nav-item active">
                    <a class="nav-link js-scroll-trigger" href="#">Register</a>
                  </li>
                  <li class="nav-item">
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
					<form id="signup-form" action="{{ url('/storeUserDetail') }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
						<input type="hidden" name="_csrf-frontend" value="nXCzlYxjOs9oSO9DxHCqWVTnhWGRhMPDFhRSV_7h_10b9MGbAU8K_DVpQlYVk0mXzxwMYrPtHL0hKftwthjC2A==">            
            <!-- Nav tabs category -->
            <!-- Tab panes -->
            <div class="tab-content faq-cat-content">
              <div class="tab-pane active in fade" id="faq-cat-1">
                <div class="col-md-12 login-right">
                  <div class="form-group">
                  	<h4 class="h4 txtchng">Project Manager Signup</h4> 
                      <br>
                  </div> 
    							<div class="profile-picture">
                    <img src="{{asset('img/users/default.png')}}" id="image" style="height: 100%;width: 100%;">
									</div>
                  <div class="row form-group">
                    <div class="col-md-3">
                      <p style="color: #343a40;">Image:</p>
                    </div>
                    <div class="col-md-9" class="form-group">
										  <input type="file" name="files" id ="files" class="form-control" style="padding: 0px 12px; overflow: hidden;text-overflow: ellipsis;" />
										</div>  

								  </div>
					 				<div class="form-group">
                    <div class="form-group field-customers-first_name">
											<input type="text" id="first_name" class="form-control" name="first_name"  placeholder="First Name">
											</div>	
                      <div class="form-group field-customers-first_name">
                      <input type="text" id="lastname" class="form-control" name="lastname"  placeholder="Last Name">
                      </div>
										<div class="form-group field-customers-company">
											<input type="text" id="customers_company" class="form-control" name="customers_company"  placeholder="Company">
										</div>	
										<div class="form-group field-customers-email">
											<input type="text" id="customers_email" class="form-control" name="customers_email"  placeholder="Email Address">
										</div>
										<div class="form-group field-customers-company">
                      <input type="password" id="customers_password" class="form-control" name="customers_password" placeholder="Password" maxlength="14">
                    </div>
                    <div class="form-group field-customers-company">
                      <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm Password" maxlength="14">
                    </div>	
										<div class="form-group field-customers-phone">
											<input type="text" id="customers_phone" class="form-control" name="customers_phone"  placeholder="Phone Number" maxlength="17">
										</div>	
										<div class="form-group check-signup" style="margin-bottom: 0px;">						<div class="form-group field-legal required">
												<input type="hidden" name="legal" value="0">
												<label>
													<input type="checkbox" id="legal" name="legal" value="1"> 
													<span><a href='javascript:void(0);' class='openmodel' rel='legal'>Terms & Conditions</a></span>
												</label>
                        <input type="hidden" name="legalhidden" id="legalhidden">
												<label id="legal-error" class="error" for="legal" style="color: #b70a0a;"></label>	

											</div>
											<label id="errormsg" class="error" style="color: #b70a0a;"></label>
										</div>	
										<div class="form-group">
							 				<button type="submit" class="btn btn-primary svbtn" name="signup" id="signup">SUBMIT</button>						
										</div>   
									</div>
								</div>					
							</div>
           	</div>
					</div>
        </form>	
      </div>
		</div>
	</div>         	
</div>
</header>
  <!-- Terms and condition -->
@include('frontview.auth.agreement')
     <!-- Footer -->
@include('frontlayouts.footer')
@include('frontlayouts.include_js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js">
</script>
<script>


document.getElementById("files").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};

$(document).ready(function () {
 
            $(".loader").fadeOut("slow");

     
    $('body').on('click','#signup', function (event) {
            event.preventDefault(); 
            
        $('#signup-form').validate({
          // initialize the plugin

          rules: {
            first_name: 
            {
              required: true,
            },
            lastname:
            {
              required: true,
            },
            customers_company: 
            {
              required: true
            },
            customers_email: 
            {
              required: true,
              email:true
            },
            customers_password: 
            {
              required: true,
              minlength:6
            },
            confirm_password: 
            {
              required: true,
              minlength:6
            },
            customers_phone: 
            {
              required: true,
              minlength:17
              
            },
            legal:
            {
            	required:true
            	
            }
            
        }
       
    });

    if($("#signup-form").valid()) {
     $(".loader").fadeIn("slow");
     var formData = new FormData($('#signup-form')[0]);
     $.ajaxSetup({
    		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
		});
      $.ajax({
            type: 'POST',
              url: $("#signup-form").attr("action"),
              data: formData,
              dataType: 'json',
              processData: false,
			        contentType: false

          })

          .done(function(msg) {
          		$(".loader").fadeOut("slow");
          		if(msg.error)
          		{
            		$("#errormsg").html(msg.error).show();
          		}
          		else
          		{
          			alert(msg.success);
					url = '<?php echo route('cmslogin'); ?>';
            		window.location.replace(url);
          		}
        	});
		  }
    });
    $('#first_name').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z ]+$");
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
$('#customers_phone').focus(function () {
    document.getElementById("customers_phone").value = '+1 (';
   
});
$("#customers_phone").keypress(function (e) {
  var regex = new RegExp("^[0-9]*$");
     var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);     
     if(e.keyCode === 8 || e.keyCode === 46)  
      return true;      
      if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
      if(!regex.test(key)){
         return false;      

      } 
    var phone = document.getElementById("customers_phone").value;
    if(!phone || phone.length < 4)
    {
    	document.getElementById("customers_phone").value = '+1 (';
    }
    if(phone.length == 7)
    {
    	document.getElementById("customers_phone").value = phone + ') ';
    }
    if(phone.length == 12)
    {
    	document.getElementById("customers_phone").value = phone + ' ';
    }
           
  }
  
  
	
});
</script>
<script type="text/javascript">
    document.getElementById("accept").onclick = function () {
      $('#myModal').modal('hide');
      document.getElementById("legal").checked = true;
      document.getElementById("legalhidden").value = 1;
      $("#legal-error").fadeOut("slow");

    };
    /* document.getElementById("reject").onclick = function () {
      $('#myModal').modal('hide');
      document.getElementById("legal").checked = false;
      $("#legal-error").html("You must agree the Terms and Conditions").show().fadeIn("slow");
               return false;
    
    };*/
    $('#lastname').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
   
    if(e.keyCode === 8 || e.keyCode === 46)  
        return true;                
        if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
            if(!regex.test(key)){
            return false;      
          }

        function firstToUpperCase( str ) {
          return str.substr(0, 1).toUpperCase() + str.substr(1);
        }
        var name = document.getElementById("lastname").value;
        var name = firstToUpperCase( name );  
        document.getElementById("lastname").value = name;
   }
});
    $('#first_name').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
   
    if(e.keyCode === 8 || e.keyCode === 46)  
        return true;                
        if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
            if(!regex.test(key)){
            return false;      
          }

        function firstToUpperCase( str ) {
          return str.substr(0, 1).toUpperCase() + str.substr(1);
        }
        var name = document.getElementById("first_name").value;
        var name = firstToUpperCase( name );  
        document.getElementById("first_name").value = name;
   }
});
    document.getElementById("legal").onclick = function () {

      var legalstatus = document.getElementById("legalhidden").value;
      if(legalstatus == 1)
      return false;
      else
      {
        $("#legal-error").html("You must read the Terms and Conditions").show().fadeIn("slow");
        return false;
      }
        
    
    };
  </script>
<script>
$(document).ready(function() 
{

	$(document).on("click",".openmodel",function()
	{
		var cls    = $(this).attr('rel');
		if(cls == 'disclaimer')
		{
			var title = 'ILA WAIVER';
			$(".sampletitle").text(title);
			$(".legal").hide();
			$(".disclaimer").show();
		}
		else if(cls == 'legal')
		{
			var title = 'SERVICE AGREEMENT';
			$(".sampletitle").text(title);
			$(".disclaimer").hide();
			$(".legal").show();

		}
		$('#myModal').modal('show');
	});
});
</script>			

</body>
</html>
