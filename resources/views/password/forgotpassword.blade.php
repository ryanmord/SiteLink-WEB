 
<html>
<head>
<meta charset="utf-8">
<title> Project_management</title>

  <link rel="shortcut icon" href="{{{ asset('img/brick-wall.png') }}}">
  <link href="{{asset('/css/themeCss/site.min.css')}}" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
  <script src="{{asset('/js/themeJs/site.min.js')}}"></script>
  <style>
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #303641;
        color: #C1C3C6
      }
    </style>
  </head>
  <body>
    <div class="container">
      <form class="form-signin" role="form" method="POST" action="{{ url('/changepassword/'.$userid) }}">
        {{ csrf_field() }}
        <h3 class="form-signin-heading">Change Password</h3>
        
         <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
          <div class="input-group">
            <div class="input-group-addon">
              <i class=" glyphicon glyphicon-lock "></i>
            </div>
            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" autocomplete="off" />
            @if ($errors->has('new_password'))
              <span class="help-block">
              <strong>{{ $errors->first('new_password') }}</strong>
              </span>
            @endif
          </div>
        </div>
         <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
          <div class="input-group">
            <div class="input-group-addon">
              <i class=" glyphicon glyphicon-lock "></i>
            </div>
            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder=" Confirm Password" autocomplete="off" />
            @if ($errors->has('confirm_password'))
              <span class="help-block">
              <strong>{{ $errors->first('confirm_password') }}</strong>
              </span>
            @endif
          </div>
        </div>
        @if(isset($warning))
         <p class="alert alert-danger">
         Error :  <br>
         Invalid Email or Password. <br>
          </p>
        @endif
      <button class="btn btn-lg btn-primary btn-block" type="submit" id="reset">Change Password</button>
      </form>

    </div>
    <script src="{{asset('/js/app.js')}}"></script>

  </body>
</html>

