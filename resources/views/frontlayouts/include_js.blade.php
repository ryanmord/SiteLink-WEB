<?php
    $currentroutename = Route::currentRouteName();
    $action = Route::currentRouteAction();
?>
<script src="{{asset('front/assets/bf068f04/jquery.js')}}"></script>
<script src="{{asset('front/assets/364402bf/yii.js')}}"></script>
<script src="{{asset('front/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Custom scripts for this template -->
<script src="{{asset('js/frontJs/agency.min.js')}}"></script>
<script src="{{asset('js/frontJs/owl.carousel.min.js')}}"></script>
<script src="{{asset('front/vendor/jquery-easing\jquery.easing.min.js')}}"></script>
    <!-- Contact form JavaScript -->
<script src="{{asset('js/frontJs/jqBootstrapValidation.js')}}"></script>
<script src="{{asset('js/frontJs/contact_me.js')}}"></script>

    <!-- Custom scripts for this template -->
<script src="{{asset('js/frontJs/jquery.dataTables.min.js')}}"></script>
<link rel="stylesheet" src="{{asset('js/frontCss/bootstrap-datepicker.css')}}">
<link rel="stylesheet" src="{{asset('js/frontCss/bootstrap-select.min.css')}}">
<script src="{{asset('js/frontJs/bootstrap-datepicker.js')}}"></script>	
<script src="{{asset('js/frontJs/jquery.validate.js')}}"></script>		
<script src="{{asset('js/frontJs/bootstrap-select.min.js')}}"></script>	
<script type="text/javascript" src="{{asset('js/frontJs/bootstrap-multiselect.js')}}"></script>	
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js">
	
</script>


 <script src="{{asset('/js/ratingsJs/jquery.star-rating-svg.js')}}"></script>
 <script src="{{asset('/js/ratingsJs/jquery.star-rating-svg.min.js')}}"></script>
<script type="text/javascript">

  	
	$("#a-settings").click(function(){
	    $.ajax({
	        type: 'GET',
	        url: '<?php echo route('getSettings'); ?>',
	        dataType: 'json',
	        success: function(response){
	          	if (response != "") { 
	          		$('#settings').modal('show');
	          		if (response['availabilityflag'] == 1) {
	          			$('.check_availability').prop('checked', true);
	          			$('.check_availability').val('1');
		        	} 
		        	if (response['notificationflag'] == 1) {
		        		$('.check_notification').prop('checked', true);	
		        		$('.check_notification').val('1');
		        	}
	          	}
	        }
	    });
	});

	$('.check_availability').change(function() {
        if(this.checked) {
            $('.check_availability').val('1');
        }
        else{
        	$('.check_availability').val('0');
        }
              
    });

    $('.check_notification').change(function() {
        if(this.checked) {
            $('.check_notification').val('1');
        }
        else{
        	$('.check_notification').val('0');
        }
              
    });

	$("#btn_save_settings").click(function(){
		var availability = $('.check_availability').val();
		var notification = $('.check_notification').val();

		$.ajax({
	        type: 'get',
	        url: '<?php echo route('updateSettings'); ?>',
	        data: {notification : notification, availability : availability},
	        dataType: 'json',
	        success: function(response){
	          //alert(response.message);
	          $('#update-msg').html('Setting updated successfully').fadeIn();
	          $('#update-msg').html('Setting updated successfully').fadeOut(5000);
	        }
	    });
	});
</script>