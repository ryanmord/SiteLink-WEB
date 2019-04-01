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
   <link href="{{asset('/css/themeCss/font.css')}}" rel="stylesheet" type="text/css">
 
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
      color: #cbcaca;
      font-size: 10px;
      float: right;
    }
     .table-td-data
      {
        text-align: left;
        vertical-align: middle;
      }
    .fa-icon-sort-desc
    {
      color: #4e4b4b;
      font-size: 10px;
      float: right;
    }
 
  </style>
   