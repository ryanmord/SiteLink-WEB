<?php
	$currentroutename = Route::currentRouteName();
    $action = Route::currentRouteAction();
?>
<!--begin::Base Styles -->
	
  <link href="{{asset('/css/themeCss/site.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('/css/themeCss/table.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('/css/themeCss/rating.css')}}" rel="stylesheet" type="text/css">
   <link href="{{asset('/css/themeCss/datepicker.css')}}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{asset('/css/ratings/star-rating-svg.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('/css/ratings/demo.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />

  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
  <style type="text/css">
   	#maxmiles-error
      {
        color: #b70a0a;
      }
      #minmiles-error
      {
        color: #b70a0a;
      }
      .table-td-th
      {
        text-align: center;
        vertical-align: middle;
      }
      .table-user-list
      {
        text-align: left;
        font-size: 12px;
        font-weight:normal;
        color: #2b2929;
      }
      .live-user-td
      {
        border-left: none;
        text-align: left;
        vertical-align: middle;
      }
      .live-user-image
      {
        max-width:20px;
        max-height:20px;
        min-width:20px;
        min-height:20px;
      }
     
    
    label.required:after{content:" *";color:red;}
    .fa-icon-sort
    {
      color: #c5bdbd;
      font-size: 10px;
    }
 
  </style>
   