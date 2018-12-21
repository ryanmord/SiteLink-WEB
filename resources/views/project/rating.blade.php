<?php
    $currentroutename = Route::currentRouteName();
    $action = Route::currentRouteAction();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title> Scoped </title>

  <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">
    @include('layouts.include_css')
    <style type="text/css">
      .rating {
  display: inline-block;
  position: relative;
  height: 50px;
  line-height: 50px;
  font-size: 50px;
}

.rating label {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  cursor: pointer;
}

.rating label:last-child {
  position: static;
}

.rating label:nth-child(1) {
  z-index: 5;
}

.rating label:nth-child(2) {
  z-index: 4;
}

.rating label:nth-child(3) {
  z-index: 3;
}

.rating label:nth-child(4) {
  z-index: 2;
}

.rating label:nth-child(5) {
  z-index: 1;
}

.rating label input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}

.rating label .icon {
  float: left;
  color: transparent;
}

.rating label:last-child .icon {
  color: #000;
}

.rating:not(:hover) label input:checked ~ .icon,
.rating:hover label:hover input ~ .icon {
  color: #09f;
}

.rating label input:focus:not(:checked) ~ .icon:last-child {
  color: #000;
  text-shadow: 0 0 5px #09f;
}
    </style>
</head>

<!-- Body -->
<body>
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <div class="wrapper theme-6-active pimary-color-pink">

    <!-- Top Menu Items -->
    @include('layouts.main_topheader')
    <!-- /Top Menu Items -->

    <!-- Left Sidebar Menu -->
    @include('layouts.main_sidebar')
    <!-- /Left Sidebar Menu -->
    <!-- Main Content -->
    <div class="page-wrapper">
        <div class="container-fluid pt-20">
<div class="col-xs-12 col-sm-9 content">
 <div class="loader" style="position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{ asset('img/Loader.gif') }}') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;"></div>
    <center>
    <div class="panel panel-success" style="text-align: left;">
      <div class="panel-heading">
        <div class="panel-title"><b>Review</b>
        </div>
        <div class="panel-options">
          <a class="bg" data-target="#sample-modal-dialog-1" data-toggle="modal" href="#sample-modal"><i class="entypo-cog"></i></a>
          <a data-rel="collapse" href="#"><i class="entypo-down-open"></i></a>
          <a data-rel="close" href="#!/tasks" ui-sref="Tasks"><i class="entypo-cancel"></i></a>
        </div>
      </div>
      <div class="panel-body">
        <form role="form" class="form-horizontal" id="setting" action="{{ url('#') }}">
          {{ csrf_field() }}
          <div class="form-group">
            
            <p style="text-align: left;margin-left: 30px;"><font size="3"> Your Project is complete. Please rate and review the associate.</font></p>
           </div>
           
           <div class="form-group">
            <label>
              <input type="radio" name="stars" value="1" />
              <span class="icon">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="2" />
              <span class="icon">★</span>
              <span class="icon">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="3" />
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>   
            </label>
            <label>
              <input type="radio" name="stars" value="4" />
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
            </label>
            <label>
              <input type="radio" name="stars" value="5" />
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
              <span class="icon">★</span>
            </label>
           </div>
          
          <div class="form-group">
            <label class="control-label" style="text-align: left;margin-left: 30px;">Comment</label>
          </div>
          <div class="form-group">
            <textarea required="" placeholder="Add review.... " id="comment" name="comment" maxlength="250" style="text-transform: initial;text-align: left;margin-left: 30px;width: 40%"></textarea>
          </div>
          <div class="form-group">
            <div class="col-md-offset-2 col-md-3">
              <button class="btn btn-success" id="changesetting" type="submit">Submit</button>
            </div>
          </div>
        </form>
    </div>
  </div>
</center>
</div>
</div>
    </div>
    <!-- /Main Content -->

   @include('layouts.include_js')
  
   <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js">
  </script>
    <script type="text/javascript">
    $(window).load(function() {
          $(".loader").fadeOut("slow");
        });
  </script>

</body>
<!-- /Body -->

</html>

 
