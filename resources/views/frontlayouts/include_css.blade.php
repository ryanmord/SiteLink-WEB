<?php
	$currentroutename = Route::currentRouteName();
    $action = Route::currentRouteAction();
?>
<link href="{{secure_asset('/css/frontCss/site.css')}}" rel="stylesheet">
<link href="{{secure_asset('front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{secure_asset('front/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
<link href="{{secure_asset('/css/frontCss/agency.min.css')}}" rel="stylesheet">
<link href="{{secure_asset('/css/frontCss/agency.css')}}" rel="stylesheet">
<link href="{{secure_asset('/css/frontCss/owl.carousel.css')}}" rel="stylesheet"> 
<link href="{{secure_asset('/css/frontCss/owl.theme.css')}}" rel="stylesheet">
<link href="{{secure_asset('/css/frontCss/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<link href="{{secure_asset('/css/frontCss/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{secure_asset('/css/frontCss/bootstrap-multiselect.css')}}" rel="stylesheet">

<link href="{{secure_asset('/css/frontCss/bootstrap-toggle.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{secure_asset('/css/ratings/star-rating-svg.css')}}">
<link rel="stylesheet" type="text/css" href="{{secure_asset('/css/ratings/demo.css')}}">
<style>
#login_email-error
{
	float: left;
}
#login_password-error
{
	float: left;
}

.loading { color: red; }
</style>