<?php echo $__env->make('frontlayouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <link href="<?php echo e(asset('/css/frontCss/map.css')); ?>" rel="stylesheet">

<!-- Header -->
<header class="masthead login sign-up">
<div class="container"> 
	<div class="intro-text">
	<div class="loader" style="position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('<?php echo e(asset('img/Loader.gif')); ?>') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;"></div>
		<div class="pdding-left">
			<div class="col-md-7 login-left">
				<h2 class="left-title">We're here for you every step of the way.</h2>
				<p>It all starts with you</p>
			</div>   
        <div class="col-md-4 plans-tab"> 
				<form action="<?php echo e(route('register')); ?>" id="signup-form" method="POST" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

	    		<input type="hidden" name="Customers[type]" id='ctype'>

		            <!-- Tab panes -->
		            <div class="tab-content faq-cat-content">
		                <div class="tab-pane active in fade" id="faq-cat-1">
		                  	<div class="col-md-12 login-right">  
		                  		
		                  		<div class="profile-picture">
		                    		<img src="<?php echo e(asset('img/users/default.png')); ?>" id="imageShow" style="height: 100%;width: 100%;">
								          </div>
		                  		<div class="form-group">
									<div class="form-group field-customers-first_name">
										<input type="file" name="image" id ="image" class="form-control" style="padding: 0px 12px; overflow: hidden;text-overflow: ellipsis;" />
									</div>  
								</div>

							 	<div class="form-group">
									<div class="form-group field-customers-first_name">
										<input type="text" id="txt_name" class="form-control" name="name"  placeholder="First Name">
										<div class="error"><?php echo e($errors->first('name')); ?></div>
									</div>	
                  <div class="form-group">
                  <div class="form-group field-customers-first_name">
                    <input type="text" id="lastname" class="form-control" name="lastname"  placeholder="Last Name">
                    <div class="error"><?php echo e($errors->first('lastname')); ?></div>
                  </div>
									<div class="form-group field-customers-company">
										<input type="text" id="txt_company" class="form-control" name="company"  placeholder="Company">
										<div class="error"><?php echo e($errors->first('company')); ?></div>
									</div>

									<div class="form-group field-customers-company">
										<input type="email" id="txt_email" class="form-control" name="email"  placeholder="Email Address">
										<div class="error"><?php echo e($errors->first('email')); ?></div>
									</div>

									<div class="form-group field-customers-company">
		                <input type="password" id="txt_password" class="form-control" name="password" placeholder="Password" maxlength="14">
		                  <div class="error"><?php echo e($errors->first('password')); ?></div>
		              </div>
                  <div class="form-group field-customers-company">
		                <input type="password" id="txt_confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm Password" maxlength="14">
		                <div class="error"><?php echo e($errors->first('confirm_password')); ?></div>
		              </div>	
									
									<div class="form-group field-customers-company">
										<input type="text" id="txt_phone" class="form-control" name="phone"  placeholder="Phone Number" maxlength="17">
										<div class="error"><?php echo e($errors->first('phone')); ?></div>
									</div>	

									<div class="form-group field-customers-company">
										<input type="text" id="address" class="form-control" name="address"  placeholder="Home Address" data-toggle="modal" data-target="#myMapModal" autocomplete="off">
										<input type="hidden" id="latitude" name="latitude" value="">
                    <input type="hidden" id="longitude" name="longitude" value="">
										<?php echo $__env->make('frontview.myMapModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
										<div class="error"><?php echo e($errors->first('address')); ?></div>
									</div>	
									<div class="form-group field-multi-select-scope">
				            <select id="ddl_scope_performed" name="scope_performed[]" multiple="multiple">
				              <?php $__currentLoopData = $scope; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                    <option value="<?php echo e($value->scope_performed_id); ?>"><?php echo e($value->scope_performed); ?> </option>
				              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				            </select>
				          </div>

									<div class="form-group check-signup" style="margin-bottom: 0px;">						
										<div class="form-group field-legal required">
											<input type="hidden" name="legal" value="0">
											<label>
												<input type="checkbox" id="legal" name="legal" value="1"> 
                       
												<span><a href='javascript:void(0);' class='openmodel' rel='legal'>Terms & Conditions</a></span>
											</label>
                       <input type="hidden" name="policystatus" id="policystatus">
											<label id="legal-error" class="error" for="legal" style="color: #b70a0a;"></label>	

										</div>
										<label id="errormsg" class="error" style="color: #b70a0a;"></label>
									</div>	
                  <div class="form-group">
									 	<button type="submit" class="btn btn-primary svbtn" 
									 	id="registraion-btn" name="registraion-btn">SUBMIT</button>						
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
<?php echo $__env->make('frontview.auth.agreement', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     <!-- Footer -->
<?php echo $__env->make('frontlayouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFesVLN0rhPhI0uHrMrQjclKdbyx9X9g0&libraries=places&callback=initMap" async defer></script>  
<script src="<?php echo e(asset('/js/frontJs/map.js')); ?>"></script>
<?php echo $__env->make('frontlayouts.include_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<script>

document.getElementById("image").onchange = function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("imageShow").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};

$(document).ready(function() {
	$(document).on("click",".openmodel",function(){
		var cls    = $(this).attr('rel');
		if(cls == 'disclaimer'){
			var title = 'ILA WAIVER';
			$(".sampletitle").text(title);
			$(".legal").hide();
			$(".disclaimer").show();
		}else if(cls == 'legal'){
			var title = 'SERVICE AGREEMENT';
			$(".sampletitle").text(title);
			$(".disclaimer").hide();
			$(".legal").show();

		}
		$('#myModal').modal('show');
	});
});
</script>			
   
 
<script type="text/javascript">
$(document).ready(function() {
  $("#login-menu").removeClass('active');
  $("#register-menu").addClass('active');
$(".loader").fadeOut("slow");
$('body').on('click','#registraion-btn', function (event) {
    event.preventDefault(); 
	$("#signup-form").validate({
		rules: {
            name: {
                required: true,
            },lastname: {
                required: true,
            },company: { 
            	required: true,
            },email: { 
                required: true,
                email: true,
            },password:{
                required: true,
              	minlength:6
            },password_confirmation:{
                required: true,
              	minlength:6,
              	equalTo :"#txt_password"
            },phone:{
            	required: true,
              	minlength:17
            },address:{
            	required:true
            },legal:{
            	required:true
            },
            "scope_performed[]": "required"
        },messages:{
            name: "Please Enter Name",
            lastname: "Please Enter Last Name",
            company: "Please Enter Company",
            email:{
            	required : "Please Enter Email Address",
            	email :"Please Enter valid email Address"
            },
            password:"Please Enter Password",
            password:{
              required : "Please Enter Password",
              minlength :"Please enter at least 6 characters."
            },
            password_confirmation:{
            	required : "Please Enter Confirm Password",
            	equalTo :"Please Enter the same password as above"
            },
            phone:"Please Enter Phone Number",
            address:"Please Enter Address",
            legal:"Please Accept Terms & Conditions",
            "scope_performed[]": "Please select scope performed"
        },errorPlacement: function(error, element) {
            error.insertAfter(element);
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
         	if(msg.status == '1')
         	{
            alert(msg.message);
         		url = '<?php echo route('AssociateLogin'); ?>';
          		window.location.replace(url);
         	}
         	else
         	{
         		$("#errormsg").text(msg.message).show();
         	}
          
        });

     }

});

    $('#ddl_scope_performed').multiselect({
       	buttonContainer: '<div id="ddl_scope_performed-container"></div>',
        onChange: function(options, selected) {
	        // Get checkbox corresponding to option:
	        var value = $(options).val();
	        var $input = $('#ddl_scope_performed-container input[value="' + value + '"]');
	        // Adapt label class:
	        if (selected) {
	            $input.closest('label').addClass('active');
	        }
	        else {
	            $input.closest('label').removeClass('active');
	        }
    	}
    });
});

$('#txt_phone').focus(function () {
    document.getElementById("txt_phone").value = '+1 (';
});

$("#txt_phone").keypress(function (e) {
  	var regex = new RegExp("^[0-9]*$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);     
    if(e.keyCode === 8 || e.keyCode === 46)  
      	return true;      
      	if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
      		if(!regex.test(key)){
         		return false;      
      		} 
    		var phone = document.getElementById("txt_phone").value;
    		if(!phone || phone.length < 4){
    			document.getElementById("txt_phone").value = '+1 (';
    		}
    		if(phone.length == 7){
    			document.getElementById("txt_phone").value = phone + ') ';
    		}
    		if(phone.length == 12){
    			document.getElementById("txt_phone").value = phone + ' ';
    		}
  		}
});

$('#txt_name').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
    
    if(e.keyCode === 8 || e.keyCode === 46 || e.keyCode === 9)  
        return true;                
       	if(!((e.keyCode == 37 && e.which == 0) || (e.keyCode == 39 && e.which == 0) || (e.keyCode == 46 && e.which == 0))){
          	if(!regex.test(key)){
         		return false;      
      		}

      	function firstToUpperCase( str ) {
        	return str.substr(0, 1).toUpperCase() + str.substr(1);
      	}
      	var name = document.getElementById("txt_name").value;
      	var name = firstToUpperCase( name );  
      	document.getElementById("txt_name").value = name;
   }
});
$('#lastname').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);  
   
    if(e.keyCode === 8 || e.keyCode === 46 || e.keyCode === 9)  
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

</script>	

<script type="text/javascript">
    document.getElementById("accept").onclick = function () {
      document.getElementById('policystatus').value = 1;
      	$('#myModal').modal('hide');
      	document.getElementById("legal").checked = true;
      	$("#legal-error").html("");
    };
   /* document.getElementById("reject").onclick = function () {
      	$('#myModal').modal('hide');
      	document.getElementById("legal").checked = false;
      	$("#legal-error").html("You must agree the Terms and Conditions").show().fadeIn("slow");
        return false;
    };*/
    document.getElementById("legal").onclick = function () {
      var status = document.getElementById('policystatus').value;
      if(status == 1)
      {
          $("#legal-error").html("");
          return false;
      }
     	
     else
     {
      $("#legal-error").html("You must read the Terms and Conditions").show().fadeIn("slow");
      return false
     }
    };
</script>


</body>
</html>
